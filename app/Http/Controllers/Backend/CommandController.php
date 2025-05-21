<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommandRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use App\Services\CommandService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use App\Traits\SystemTrait;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CommandController extends Controller
{
    use SystemTrait;

    protected $CommandService;

    public function __construct(CommandService $CommandService)
    {
        $this->CommandService = $CommandService;
    }

    public function index()
    {
        return Inertia::render(
            'Backend/Command/Index',
            [
                'pageTitle' => fn() => 'Command List',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Command Manage'],
                    ['link' => route('backend.command.index'), 'title' => 'Command List'],
                ],
                'tableHeaders' => fn() => $this->getTableHeaders(),
                'dataFields' => fn() => $this->dataFields(),
                'datas' => fn() => $this->getDatas(),
            ]
        );
    }

    private function getDatas()
    {
        $query = $this->CommandService->list();


        $datas = $query->paginate(request()->numOfData ?? 10)->withQueryString();

        $columnNames = Schema::getColumnListing('commands');
        $formatedDatas = $datas->map(function ($data, $index) use ($columnNames) {
            $customData = new \stdClass();
            $customData->index = $index + 1;

            // Iterate through each column name and set the corresponding property in $customData
            foreach ($columnNames as $columnName) {
                // Check if the column exists in the $data object before accessing it
                if ($columnName == 'created_at' || $columnName == 'updated_at' || $columnName == 'deleted_at') {

                    continue;
                }
                if (isset($data->$columnName)) {
                    if ($columnName == 'image' || $columnName == 'file') {
                        $customData->$columnName = '<img src="' . $data->$columnName . '" height="50" width="50"/>';
                    } else {
                        $customData->$columnName = $data->$columnName;
                    }
                } else {
                    $customData->$columnName = null; // Or you can set a default value if the column doesn't exist
                }
            }

            // Set other properties as before
            $customData->status = getStatusText($data->status);
            $customData->hasLink = true;
            $customData->links = [
                [
                    'linkClass' => 'semi-bold text-white statusChange ' . (($data->status == 'Active') ? "bg-gray-500" : "bg-green-500"),
                    'link' => route('backend.command.status.change', ['id' => $data->id, 'status' => $data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel((($data->status == 'Active') ? "Inactive" : "Active"), null, null)
                ],
                [
                    'linkClass' => 'bg-yellow-400 text-black semi-bold',
                    'link' => route('backend.command.edit', [$data->id]),
                    'linkLabel' => getLinkLabel('Edit', null, null)
                ],
                [
                    'linkClass' => 'deleteButton bg-red-500 text-white semi-bold',
                    'link' => route('backend.command.destroy', $data->id),
                    'linkLabel' => getLinkLabel('Delete', null, null)
                ]
            ];
            return $customData;
        });

        return regeneratePagination($formatedDatas, $datas->total(), $datas->perPage(), $datas->currentPage());
    }

    private function dataFields()
    {

        $columnNames = Schema::getColumnListing('commands');
        $fields = [];

        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['created_at', 'updated_at', 'deleted_at'])) {
                $fields[] = [
                    'fieldName' => $columnName,
                    'class' => 'text-center'
                ];
            }
        }

        return $fields;
    }

    private function getTableHeaders()
    {
        return [
            'Sl/No',
            'Model',
            'Controller',
            'Database table',
            'Status',
            'Action'
        ];
    }

    public function create()
    {
        return Inertia::render(
            'Backend/Command/Form',
            [
                'pageTitle' => fn() => 'Command Create',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Command Manage'],
                    ['link' => route('backend.command.create'), 'title' => 'Command Create'],
                ],
            ]
        );
    }


    public function store(CommandRequest $request)
    {


        $data = $request->validated();
        if (empty($request->fields)) {
            return redirect()->back()->with('errorMessage', 'Any table field is not found ');
        }
        foreach ($request->fields as $field) {
            if (isset($field['relational_table']) && !Schema::hasTable($field['relational_table'])) {
                return redirect()->back()->with('errorMessage', $field['relational_table']." Table does not exist in database");
            }
        }

        // Generate Migration Start
        $date_time = now()->format('Y_m_d_His_');
        $filePath = base_path("database/migrations/{$date_time}create_{$request->database_table}_table.php");

        // Load the stub and replace placeholders
        $stub = file_get_contents(base_path('stubs/migration.stub'));
        $tableFields = $this->generateTableFields($request->fields);
        $migrationContent = str_replace(['{{table}}', '{{tableFields}}'], [$request->database_table, $tableFields], $stub);

        // Create migration file
        if (file_put_contents($filePath, $migrationContent) === false) {
            return redirect()->back()->with('errorMessage', "Failed to write migration file to {$filePath}");
        }

        // Run migrations with validation
        $exitCode = Artisan::call('migrate:fresh --seed');
        if ($exitCode !== 0) {
            // Capture migration error output
            $migrateOutput = Artisan::output();
            return redirect()->back()->with('errorMessage', "Failed to write migration file to  $migrateOutput");
        }

        // Run MVC generation command
        $exitMvcCode = Artisan::call("create:mvc {$request->controller} {$request->model} {$request->database_table}");


        if ($exitMvcCode !== 0) {
            // Capture migration error output
            $mvcOutput = Artisan::output();
            return redirect()->back()->with('errorMessage', "Failed to write mvc file to $mvcOutput");
        }

        // Return success response
        return redirect()->back()->with('successMessage', 'Command created successfully');
    }


    protected function generateTableFields($fields)
    {
        $tableFields = '';

        foreach ($fields as $field) {
            // Start building the field definition with the field name

            if (!$field['name']) {
                continue;
            }
            if ($field['relational_table']) {
                $fieldDefinition = '$table->unsignedBigInteger' . "('{$field['name']}'";
            } else {
                $fieldDefinition = '$table->' . strtolower($field['type']) . "('{$field['name']}'";
            }


            // Handle length for certain types
            if (in_array($field['type'], ['VARCHAR', 'CHAR', 'DECIMAL', 'FLOAT', 'DOUBLE'])) {
                $fieldDefinition .= ", {$field['length']})";
            } else {
                $fieldDefinition .= ')';
            }

            // Check for nullable
            if ($field['relational_table']) {
                $fieldDefinition .= '->nullable()';
            } else {
                if (isset($field['nullable']) && $field['nullable']) {
                    $fieldDefinition .= '->nullable()';
                }
            }



            // Check for default value
            if (isset($field['defaultValue']) && $field['defaultValue'] !== null) {
                $fieldDefinition .= "->default('{$field['defaultValue']}')";
            }

            // Ensure the method call ends with parentheses
            $fieldDefinition .= ';';

            // Add to the fields string with indentation for readability
            $tableFields .= "    {$fieldDefinition}\n";
            if ($field['relational_table']) {
                $tableFields .= "    \$table->foreign('{$field['name']}')->references('id')->on('{$field['relational_table']}')->onDelete('set null');\n";
            }
        }

        return $tableFields;
    }


    private function createFile($filePath)
    {
        if (File::exists($filePath)) {
            $this->error('File already exists: ' . $filePath);
            return;
        }

        File::put($filePath, 'created');
    }

    public function edit($id)
    {
        $command = $this->CommandService->find($id);

        return Inertia::render(
            'Backend/Command/Form',
            [
                'pageTitle' => fn() => 'Command Edit',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Command Manage'],
                    ['link' => route('backend.command.edit', $id), 'title' => 'Command Edit'],
                ],
                'command' => fn() => $command,
                'id' => fn() => $id,
            ]
        );
    }

    public function update(CommandRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $command = $this->CommandService->find($id);

            if ($request->hasFile('image')) {
                $data['image'] = $this->imageUpload($request->file('image'), 'commands');
                $path = strstr($command->image, 'storage/');
                if (file_exists($path)) {
                    unlink($path);
                }
            } else {

                $data['image'] = strstr($command->image ?? '', 'commands');
            }

            if ($request->hasFile('file')) {
                $data['file'] = $this->fileUpload($request->file('file'), 'commands/');
                $path = strstr($command->file, 'storage/');
                if (file_exists($path)) {
                    unlink($path);
                }
            } else {

                $data['file'] = strstr($command->file ?? '', 'commands/');
            }

            $dataInfo = $this->CommandService->update($data, $id);

            if ($dataInfo->save()) {
                $message = 'Command updated successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'commands', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To update commands.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'CommandController', 'update', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();

        try {

            if ($this->CommandService->delete($id)) {
                $message = 'Command deleted successfully';
                $this->storeAdminWorkLog($id, 'commands', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete Command.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'CommandController', 'destroy', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function changeStatus(Request $request, $id, $status)
    {
        DB::beginTransaction();

        try {

            $dataInfo = $this->CommandService->changeStatus($id, $status);

            if ($dataInfo->wasChanged()) {
                $message = 'Command ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'commands', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . "Command.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'CommandController', 'changeStatus', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }
}
