<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Request $request)
{
    // Get filters from the request
    $filters = $request->only(['exam_name', 'class', 'section', 'grade']);

    $marks = Mark::with(['student', 'exam'])
        ->when($request->exam_name, function($query) use ($request) {
            return $query->where('exam_id', $request->exam_name);
        })
        ->when($request->class, function($query) use ($request) {
            return $query->whereHas('student', function($query) use ($request) {
                return $query->where('class', $request->class);
            });
        })->get();

        $exams = Exam::select(['id','exam_name'])->get();
        $classes = Student::select(['id','class'])->get();
        // $grades = Grade::select(['id','grade'])->get();

    // Render the report view with the filtered marks
    return view('reports.index', compact('marks','exams','classes'));
}

}
