<?php

namespace App\Imports;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Exam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        // Match the Excel columns to your database fields
        $student = Student::where('name', $row['student'])->first(); // assuming student name is in the first column
        $exam = Exam::where('exam_name', $row['exam_name'])->first(); // assuming exam name is in the second column
        // dd($student);
        return new Mark([
            'student_id' => $student->id,
            'exam_id' => $exam->id,
            'subject' => $row['subject'],
            'marks' => $row['marks'],
        ]);
    }
}
