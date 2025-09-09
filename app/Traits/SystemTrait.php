<?php

namespace App\Traits;

use App\Models\CmsSetting;
use App\Models\Description;
use App\Models\Employee;
use App\Models\RolePermission;
use Illuminate\Support\Str;
use App\Models\SystemErrorLog;
use App\Models\SystemLog;
use App\Models\Website;
use App\Models\WebsiteMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait SystemTrait
{

    /**
     * @param Request $request
     * @return $this|false|string
     */


    public function successResponse($message, $url, $data)
    {

        return [
            'message' => $message,
            'redirectUrl' => $url,
            'data' => $data,
            'status' => true,
        ];
    }
    public function warningResponse($message, $url, $data)
    {

        return [
            'warningMessage' => $message,
            'redirectUrl' => $url,
            'data' => $data,
            'status' => false,
        ];
    }
    public function errorResponse($message, $url, $data)
    {

        return [
            'errorMessage' => $message,
            'redirectUrl' => $url,
            'data' => $data,
            'status' => false,
        ];
    }

    public function storeAdminWorkLog($dataId, $referenceTable, $note)
    {

        $data = [
            'data_id' => $dataId,
            'admin_id' => auth('admin')->user()->id ?? auth('employee')->user()->id,
            'reference_table' => $referenceTable,
            'note' => $note,
            'created_at' => currentTimeStamp(),
        ];



        SystemLog::create($data);
    }


    public function storeSystemError($namespace, $controller, $function, $log)
    {

        $data = [
            'namespace' => $namespace,
            'controller' => $controller,
            'function' => $function,
            'log' => $log,
            'created_at' => currentTimeStamp(),
        ];

        SystemErrorLog::create($data);
    }

    public function imageUpload($imageFile, $folder, $blurIntensity = 0, $height = null, $width = null)
    {
        if (!file_exists(storage_path('app/public/' . $folder))) {
            mkdir(storage_path('app/public/' . $folder), 0755, true);
        }

        $imageName = time() . '.' . $imageFile->extension();

        $imageFile->move(storage_path('app/public/' . $folder), $imageName);

        $imagePath = storage_path('app/public/' . $folder . '/' . $imageName);

        if ($width && $height) {
            $originalImage = imagecreatefromstring(file_get_contents($imagePath));
            $resizedImage = imagecreatetruecolor($width, $height);

            $originalWidth = imagesx($originalImage);
            $originalHeight = imagesy($originalImage);

            imagecopyresampled(
                $resizedImage,
                $originalImage,
                0,
                0,
                0,
                0,
                $width,
                $height,
                $originalWidth,
                $originalHeight
            );

            imagejpeg($resizedImage, $imagePath, 90);

            imagedestroy($originalImage);
            imagedestroy($resizedImage);
        }


        if ($blurIntensity > 0) {
            $originalImage = imagecreatefromstring(file_get_contents($imagePath));

            for ($i = 0; $i < $blurIntensity; $i++) {
                imagefilter($originalImage, IMG_FILTER_GAUSSIAN_BLUR);
            }

            imagejpeg($originalImage, $imagePath, 90);
            imagedestroy($originalImage);
        }

        return $folder . '/' . $imageName;
    }

    public function fileUpload($file, $folder)
    {
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $file->storeAs($folder, $fileName, 'public');
        return $folder . '/' . $fileName;
    }
    public function storeDescription($dataId, $referenceTable, $description, $type = 'en')
    {
        $index = 0;

        $breakPoint = 0;

        $segment = '';

        $flag = true;

        while ($index < strlen($description)) {

            $segment = $segment . $description[$index];

            $index++;

            $breakPoint++;

            if ($breakPoint == (strlen($description) - 1)) {

                $flag = $this->storeDescriptionSegment($dataId, $referenceTable, $segment, $type);

                if (!$flag)
                    break;

                $breakPoint = 0;

                $segment = "";

                break;
            }

            if ($breakPoint == 10000) {

                $flag = $this->storeDescriptionSegment($dataId, $referenceTable, $segment, $type);

                if (!$flag)
                    break;

                $breakPoint = 0;

                $segment = "";
            }
        }

        return $flag;
    }


    public function checkAuthentication($route)
    {
        $role_id = auth()->guard('admin')->user()->role_id;

        if ($role_id == 1) {

            return true;
        } else {

            $permissionRoute = RolePermission::where('uri', $route)->first();

            if ($permissionRoute) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function allowanceCalculation($employee_id)
    {

        $employee = Employee::with('section')->find($employee_id);


        if (!$employee->section) {
            return response()->json(['error' => 'Section not found'], 404);
        }


        $parsePercentage = function ($value) {
            return floatval(str_replace('%', '', $value));
        };

        // এখন allowances হিসাব করবো
        $medicalAmount =  ($employee->basic * $parsePercentage($employee->section->medical)) / 100;
        $houseRentAmount =  ($employee->basic * $parsePercentage($employee->section->house_rent)) / 100;
        $convenceAmount = ($employee->basic * $parsePercentage($employee->section->convence)) / 100;


        // Total salary calculation
        $totalSalary = $employee->basic + $medicalAmount + $houseRentAmount + $convenceAmount;

        return [
            'basic_salary' => $employee->basic,
            'medical_amount' => $medicalAmount,
            'house_rent_amount' => $houseRentAmount,
            'convence_amount' => $convenceAmount,
            'gross_salary' => $totalSalary,
        ];
    }


    public function lateAdjustment($monthlyAttendanceData)
    {
        if ($monthlyAttendanceData->is_late_adjustment == 1) {

            $total_late = $monthlyAttendanceData->total_late;
            $reduce_salary_no_of_day = floor($total_late / 3);
            $total_working_day = $monthlyAttendanceData->total_working_days;
            $basic = $monthlyAttendanceData->employee->basic;

            if ($total_working_day == 0 || $reduce_salary_no_of_day == 0) {
                return 0;
            }


            $per_day_basic_salary = $basic / $total_working_day;

            // Total reduce amount
            $reduce_amount = $per_day_basic_salary * $reduce_salary_no_of_day;

            return floor($reduce_amount);
        } else {
            return 0;
        }
    }
    public function absentAdjustment($monthlyAttendanceData)
    {
        if ($monthlyAttendanceData->is_absent_adjustment == 1) {

            $total_absent = $monthlyAttendanceData->absent;
            $total_working_day = $monthlyAttendanceData->total_working_days;
            $basic = $monthlyAttendanceData->employee->basic;

            if ($total_working_day == 0 || $total_absent == 0) {
                return 0;
            }


            $per_day_basic_salary = $basic / $total_working_day;

            // Total reduce amount
            $reduce_amount = $per_day_basic_salary * $total_absent;

            return floor($reduce_amount);
        } else {
            return 0;
        }
    }

    public function overtimeAdjustment(){
        return 0;
    }

    public function getWebsiteData(Request $request): array
    {
        $slug = $request->segment(1);

        $website = Website::where("slug", $slug)->firstOrFail();

        $website_menus = WebsiteMenu::where("website_id", $website->id)
            ->with(["children", "page"])
            ->whereNull("parent_id")
            ->orderBy("order")
            ->get();

        $cmsSetting = CmsSetting::where("website_id", $website->id)->first() ;//for header footer

        return compact("slug", "website", "website_menus", "cmsSetting");
    }
}
