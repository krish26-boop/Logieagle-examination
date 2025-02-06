<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    //     public function index(Request $request)
    // {
    //     // Get filters from the request
    //     $filters = $request->only(['exam_name', 'class', 'section', 'grade']);

    //     $marks = Mark::with(['student', 'exam'])
    //         ->when($request->exam_name, function($query) use ($request) {
    //             return $query->where('exam_id', $request->exam_name);
    //         })
    //         ->when($request->class, function($query) use ($request) {
    //             return $query->whereHas('student', function($query) use ($request) {
    //                 return $query->where('class', $request->class);
    //             });
    //         })->get();

    //             // dd($marks);
    //         $subjects = Mark::select('subject')->distinct()->pluck('subject');
    //         $exams = Exam::select('exam_name')->distinct()->pluck('exam_name');
    //         $classes = Student::select('class')->distinct()->pluck('class');
    //         $sections = Student::select('section')->distinct()->pluck('section');
    //         $genders = Student::select('gender')->distinct()->pluck('gender');
    //         $grades = Grade::select('grade')->distinct()->pluck('grade');


    //     // Render the report view with the filtered marks
    //     return view('reports.index', compact('marks','exams','classes','sections','genders','grades','subjects'));
    // }

    // public function index(Request $request)
    // {
    //     // Get filters
    //     $filters = $request->only(['exam_name', 'class', 'section', 'grade']);

    //     // Fetch marks with relationships
    //     // $marks = Mark::with(['student', 'exam'])
    //     //     ->when($request->exam_name, fn($query) => $query->where('exam_id', $request->exam_name))
    //     //     ->when($request->class, fn($query) => $query->whereHas('student', fn($q) => $q->where('class', $request->class)))
    //     //     ->when($request->grade, fn($query) => $query->whereHas('student', fn($q) => $q->where('grade', $request->grade)))
    //     //     ->get();

    //     // // Extract subjects dynamically from marks table
    //     // $subjects = $marks->pluck('subject')->unique(); // Assuming `subject_name` exists in marks table
    //     // // Get grades from grades table
    //     // $grades = Grade::orderBy('from', 'desc')->get();

    //     // // Prepare report data
    //     // $reportData = [];

    //     // foreach ($grades as $grade) {
    //     //     foreach ($subjects as $subject) {
    //     //         // Filter marks for specific subject and grade range
    //     //         // $records = $marks->where('subject', $subject)->filter(function ($mark) use ($grade) {

    //     //         //     return $mark->marks >= $grade->from && $mark->marks <= $grade->to;
    //     //         // });
    //     //         $records = $marks->filter(function ($mark) use ($grade) {
    //     //             return intval($mark->marks) >= intval($grade->min_marks) && intval($mark->marks) <= intval($grade->max_marks);
    //     //         });

    //     //         dd([
    //     //             'subject' => $subject,
    //     //             'grade' => $grade,
    //     //             'marks_in_subject' => $marks->pluck('marks'),
    //     //             'filtered_records' => $marks->filter(function ($mark) use ($grade) {
    //     //                 return $mark->marks >= $grade->from && $mark->marks <= $grade->to;
    //     //             }),
    //     //         ]);
    //     //         dd($marks, $records,$grade);

    //     //         dd($records);

    //     //         $totalStudents = count($records);
    //     //         $passingMarks = $records->first()->exam->passing_marks;
    //     //         $totalPass = $records->where('marks', '>=', $passingMarks)->count(); 

    //     //         $reportData[$grade->grade_name][$subject] = [
    //     //             'total_students' => $totalStudents,
    //     //             'total_pass' => $totalPass,
    //     //             'pass_percentage' => $totalStudents ? round(($totalPass / $totalStudents) * 100, 2) . '%' : '0%',
    //     //         ];
    //     //     }
    //     // }
    //     $marksData = Mark::with(['student', 'exam'])
    //         ->select(
    //             'grades.grade',
    //             'marks.subject',
    //             DB::raw('SUM(marks.marks) as total_marks'),
    //             DB::raw('COUNT(*) as student_count'),
    //             DB::raw('SUM(CASE WHEN marks.marks >= exams.passing_marks THEN 1 ELSE 0 END) * 100 / COUNT(*) as pass_percentage')
    //         )
    //         ->join('students', 'marks.student_id', '=', 'students.id')
    //         ->join('exams', 'marks.exam_id', '=', 'exams.id')
    //         ->join('grades', function ($join) {
    //             $join->on('marks.marks', '>=', 'grades.from')
    //                 ->on('marks.marks', '<=', 'grades.to');
    //         })
    //         ->groupBy('grades.grade', 'marks.subject') // Only include columns that are grouped
    //         ->get();

    //     // Arrange data in a structured format
    //     $reportData = [];
    //     $subjects = Mark::distinct()->pluck('subject')->toArray(); // Get all subjects

    //     foreach ($marksData as $row) {
    //         $grade = $row->grade;
    //         $subject = $row->subject;

    //         if (!isset($reportData[$grade])) {
    //             $reportData[$grade] = array_fill_keys($subjects, 0);
    //             $reportData[$grade]['Total'] = 0;
    //             $reportData[$grade]['% Pass'] = 0;
    //         }

    //         $reportData[$grade][$subject] = $row->total_marks;
    //         $reportData[$grade]['Total'] += $row->total_marks;
    //         $reportData[$grade]['% Pass'] = $row->pass_percentage;
    //     }
    //     // dd($gradesData);

    //     // Apply filters dynamically
    //     // if ($request->exam_name) {
    //     //     $query->whereHas('exam', function ($q) use ($request) {
    //     //         $q->where('name', 'like', '%' . $request->exam_name . '%');
    //     //     });
    //     // }

    //     // if ($request->class) {
    //     //     $query->whereHas('student', function ($q) use ($request) {
    //     //         $q->where('class', $request->class);
    //     //     });
    //     // }

    //     // // Get data
    //     // $reportData = $query;



    //     // $subjects = Mark::select('subject')->distinct()->pluck('subject');
    //     $exams = Exam::select('exam_name')->distinct()->pluck('exam_name');
    //     $classes = Student::select('class')->distinct()->pluck('class');
    //     $sections = Student::select('section')->distinct()->pluck('section');
    //     $genders = Student::select('gender')->distinct()->pluck('gender');
    //     $grades = Grade::select('grade')->distinct()->pluck('grade');




    //     return view('reports.index', compact('reportData', 'exams', 'classes', 'sections', 'genders', 'grades', 'subjects'));
    // }

    public function index(Request $request)
{
    $query = Mark::with(['student', 'exam'])
        ->join('students', 'marks.student_id', '=', 'students.id')
        ->join('exams', 'marks.exam_id', '=', 'exams.id')
        ->join('grades', function ($join) {
            $join->on('marks.marks', '>=', 'grades.from')
                 ->on('marks.marks', '<=', 'grades.to');
        })
        ->where('exams.exam_name', $request->exam_name)
        ->where('students.class', $request->class)
        ->where('students.gender', $request->gender);

    // Section filter (optional)
    if ($request->section) {
        $query->where('students.section', $request->section);
    }

    // Handle grade filters
    $grades = $request->grades ?? [];
    if (count($grades) == 1) {
        $selectedGrade = $request->grades[0];
        $gradeCondition = $request->grade_condition;

        // Apply filter based on the condition (only, above, below)
        if ($gradeCondition == 'only') {
            $query->where('grades.grade', $selectedGrade);
        } elseif ($gradeCondition == 'above') {
            $query->where('marks.marks', '>', $this->getGradeBoundary($selectedGrade));
        } elseif ($gradeCondition == 'below') {
            $query->where('marks.marks', '<', $this->getGradeBoundary($selectedGrade));
        }
    } elseif (count($grades) > 1) {
        // If multiple grades are selected, enforce "only" condition
        $query->whereIn('grades.grade', $request->grades);
    }

    // Fetch filtered data
    $reportData = $query->select(
        'grades.grade',
        'marks.subject',
        DB::raw('SUM(marks.marks) as total_marks'),
        DB::raw('COUNT(*) as student_count'),
        DB::raw('SUM(CASE WHEN marks.marks >= exams.passing_marks THEN 1 ELSE 0 END) * 100 / COUNT(*) as pass_percentage')
    )
    ->groupBy('grades.grade', 'marks.subject')
    ->get();
        // dd($reportData);
        $subjects = Mark::select('subject')->distinct()->pluck('subject');
        $exams = Exam::select('exam_name')->distinct()->pluck('exam_name');
        $classes = Student::select('class')->distinct()->pluck('class');
        $sections = Student::select('section')->distinct()->pluck('section');
        $genders = Student::select('gender')->distinct()->pluck('gender');
        $grades = Grade::select('grade')->distinct()->pluck('grade');

    // Return filtered data to the view
    return view('reports.index', compact('reportData','exams', 'classes', 'sections', 'genders', 'grades', 'subjects'));
}

private function getGradeBoundary($grade)
{
    // Get the boundary for the grade (this could be a static value or fetched from the database)
    $gradeBoundary = Grade::where('grade', $grade)->first();
    return $gradeBoundary->to; // This assumes 'to' is the upper limit of the grade
}

}
