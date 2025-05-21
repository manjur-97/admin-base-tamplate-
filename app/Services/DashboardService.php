<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Advance;
use App\Models\Employee;
use App\Models\FingerprintAttendance;
use App\Models\Holiday;
use App\Models\LateRequest;
use App\Models\LeaveApplication;
use App\Models\Loan;
use App\Models\LoanAdjustment;
use App\Models\Notice;
use App\Models\Section;

class DashboardService
{
    protected $adminModel;

    public function __construct(Admin $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function countActiveUser()
    {
        return $this->adminModel->whereNull('deleted_at')
            ->where('status', 'Active')->count();
    }
    public function countInActiveUser()
    {
        return $this->adminModel->whereNull('deleted_at')
            ->where('status', 'Active')->count();
    }
    public function countEmployee()
    {
        return Employee::whereNull('deleted_at')
            ->where('status', 'Active')->count();
    }
    public function countSection()
    {
        return Section::whereNull('deleted_at')
            ->where('status', 'Active')->count();
    }
    public function countLeave()
    {
        return LeaveApplication::whereNull('deleted_at')
            ->where('status', 'Pending')

            ->count();
    }
    public function countLoan()
    {
        return Loan::whereNull('deleted_at')

            ->where('status', 'Pending')->count();
    }
    public function countAdvance()
    {
        return Advance::whereNull('deleted_at')

            ->where('status', 'Pending')->count();
    }
    public function lateAbsentRequestCount()
    {
        return LateRequest::whereNull('deleted_at')

            ->where('status', 'Pending')->count();
    }
    public function countDailyLateAttendance()
    {

        return FingerprintAttendance::whereNull('deleted_at') // Filter out soft-deleted records
            ->whereDate('attendance_date', '=', date('Y-m-d')) // Match today's date
            ->where('status', 'Late') // Only count records with status 'Late'
            ->count();
    }
    public function countLoanAmountByMonth()
    {
        // Initialize data with 0 for all months
        $loanData = array_fill(1, 12, 0);

        // Fetch loan amounts grouped by month for the current year
        $results = Loan::whereNull('deleted_at')
            ->whereYear('created_at', now()->year) // Filter by the current year
            ->selectRaw('MONTH(created_at) as month, SUM(loan_amount) as total_amount')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->where('status', '!=', 'Pending')
            ->get();

        // Populate loan data
        foreach ($results as $result) {
            $loanData[$result->month] = $result->total_amount;
        }
        return  $loanData;
    }

    public function countLoanCollectionAmountByMonth()
    {
        // Initialize data with 0 for all months
        $loanCollectionData = array_fill(1, 12, 0);

        // Fetch loan amounts grouped by month for the current year
        $results = LoanAdjustment::whereNull('deleted_at')
            ->whereYear('created_at', now()->year) // Filter by the current year
            ->selectRaw('MONTH(created_at) as month, SUM(adjustment_amount) as total_amount')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->where('status',  'Active')
            ->get();

        // Populate loan data
        foreach ($results as $result) {
            $loanCollectionData[$result->month] = $result->total_amount;
        }
        return  $loanCollectionData;
    }

    public function activeListPaginated()
    {
        return Employee::with('section')
            ->where('status', 'Active')
            ->paginate(10);
    }
    public function upcomingHolidays()
    {

        return Holiday::whereNull('deleted_at')
            ->where('start_date', '>', now()) // Assuming the date field is named 'date'
            ->orderBy('start_date', 'asc')   // Ensure holidays are sorted by date
            ->take(5)                  // Limit the result to 5 entries
            ->get();
    }
    public function notices()
    {

        return Notice::whereNull('deleted_at')
            ->orderBy('id', 'desc')   // Ensure holidays are sorted by date
            ->take(3)                  // Limit the result to 5 entries
            ->get();
    }

    //Employee Dashboard

    public function getTodayAttendanceStatus($employeeId)
    {
        $today = currentDate();

        return FingerprintAttendance::where('employee_id', $employeeId)
            ->whereDate('attendance_date', $today)
            ->select('status')
            ->first();
    }

    public function countMonthlyLateAttendance($employeeId)
    {

        $currentMonth = numOfMonth(currentDate());
        $currentYear = numOfYear(currentDate());

        return FingerprintAttendance::where('employee_id', $employeeId)
            ->whereMonth('attendance_date', $currentMonth)
            ->whereYear('attendance_date', $currentYear)
            ->where('status', 'Late')
            ->count();
    }
    public function countMonthlyAbsentAttendance($employeeId)
    {

        $currentMonth = numOfMonth(currentDate());
        $currentYear = numOfYear(currentDate());

        return FingerprintAttendance::where('employee_id', $employeeId)
            ->whereMonth('attendance_date', $currentMonth)
            ->whereYear('attendance_date', $currentYear)
            ->where('status', 'Absent')
            ->count();
    }

    public function countMonthlyLeaves($employeeId)
    {

        $currentMonth = numOfMonth(currentDate());
        $currentYear = numOfYear(currentDate());


        $totalLeaves = LeaveApplication::where('employee_id', $employeeId)
            ->whereMonth('date_from', $currentMonth)
            ->whereYear('date_from', $currentYear)
            ->where('status', 'Approve')
            ->count();

        return $totalLeaves ?? 0;
    }

    public function getEmployeeLeaveHistory($employeeId)
    {
        return LeaveApplication::where('employee_id', $employeeId)
            ->with('leaveType')
            ->orderBy('date_from', 'desc')
            ->limit(4)
            ->get();
    }

    public function getUpcomingHolidays()
    {
        return Holiday::where('status', 'Active')
            ->whereYear('start_date', numOfYear(currentDate()))
            ->whereDate('start_date', '>=', currentDate())
            ->orderBy('start_date', 'asc')
            ->limit(5)
            ->get();
    }

    public function getEmployeeLoanStats($employeeId)
    {

        $runningLoans = Loan::where('employee_id', $employeeId)
            ->whereNotIn('status', ['Paid and Closed', 'Deleted'])
            ->get();


        $totalLoanAmount = $runningLoans->sum('loan_amount');


        $totalAmountPaid = LoanAdjustment::whereHas('loan', function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId)
                ->whereNotIn('status', ['Paid and Closed', 'Deleted']);
        })
            ->sum('adjustment_amount');


        $totalAmountUnpaid = $totalLoanAmount - $totalAmountPaid;


        $runningLoansCount = $runningLoans->count();

        return [
            'total_loan_amount' => $totalLoanAmount,
            'total_amount_paid' => $totalAmountPaid,
            'total_amount_unpaid' => $totalAmountUnpaid,
            'running_loans_count' => $runningLoansCount,
        ];
    }

    public function getEmployeeLateReq($employeeId)
    {
        $lateRequests = LateRequest::whereHas('attendance', function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId);
        })
            ->whereMonth('created_at', numOfMonth(currentDate()))
            ->whereYear('created_at', numOfYear(currentDate()))
            ->get();

        return response()->json([
            'lateRequests' => $lateRequests,
        ]);
    }
}
