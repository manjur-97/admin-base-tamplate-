<?php

namespace App\Imports;

use App\Models\FingerprintAttendance;
use Maatwebsite\Excel\Concerns\ToModel;

class FingerprintAttendanceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FingerprintAttendance([
            'user_id'     => $row[0],
            'employee_id'    => $row[1],
            'employee_name'    => $row[2],
            'attendance_date'    => $row[3],
            'check_in'    => $row[4],
            'check_in'    => $row[5],
          
        ]);
    }
}
