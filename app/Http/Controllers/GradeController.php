<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Grade::all());
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
            'from' => 'required|integer',
            'to' => 'required|integer',
            'grade' => 'required|string',
        ]);

        Grade::create($request->all());
        return response()->json(['message' => 'Grade Details added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
        return response()->json($grade);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
        $request->validate([
            'from' => 'required|integer',
            'to' => 'required|integer',
            'grade' => 'required|string',
        ]);
    
        $grade->update($request->all());

        return response()->json(['message' => 'Grade Details updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
        $grade->delete();

        return response()->json(['message' => 'Grade Details deleted successfully!']);
    }
}
