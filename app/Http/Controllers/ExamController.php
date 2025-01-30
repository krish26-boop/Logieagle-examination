<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MarksImport;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Exam::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'exam_name' => 'required|string',
            'passing_marks' => 'required|integer',
            'class' => 'required|string',
        ]);
    
        Exam::create($request->all());
        return response()->json(['message' => 'Exam Details added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
        return response()->json($exam);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
        $request->validate([
            'exam_name' => 'required|string',
            'passing_marks' => 'required|integer',
            'class' => 'required|string',
        ]);
    
        $exam->update($request->all());

        return response()->json(['message' => 'Exam Details updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
        $exam->delete();

        return response()->json(['message' => 'Exam Details deleted successfully!']);

    }

    public function uploadMark() {
       return view('uploadMarks.index');
    }

    public function uploadMarks(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', 
        ]);

        try {
            $file = $request->file('file');
            Excel::import(new MarksImport, $file);
            return response()->json(['message' => 'Marks Imported Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Import failed: ' . $e->getMessage()], 500);
        }

    }
    
}
