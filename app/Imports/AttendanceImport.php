<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel, WithHeadingRow
{
    protected $quizCache = [];
    protected $questionIdsToKeep = [];

    public function model(array $row) {}

    public function afterImport($quizId) {}
}
