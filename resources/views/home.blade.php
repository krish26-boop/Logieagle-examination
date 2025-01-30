@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Exam Module Section -->
        <div class="card p-4 mb-4">
            <h4 class="fw-bold">EXAM MODULE</h4>
            <div class="d-flex justify-content-between">
                <a  href="{{ route('reports.index') }}" class="btn btn-info">Reports</a>
                <a  href="{{ url('/upload-mark') }}" class="btn btn-dark">Upload Marks</a>
            </div>
            <table class="table mt-3" id="ExamsTable">
                <thead>
                    <tr>
                        <th>Exam Name</th>
                        <th>Class</th>
                        <th>Passing Marks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- Add Exam Section -->
        <div class="card p-4 mb-4">
            <h5 class="fw-bold">Add Exam</h5>
            <form id="examForm">
                @csrf
                <input type="hidden" id="examId" name="id">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Exam Name</label>
                        <input type="text" id="exam_name" name="exam_name" class="form-control">
                    </div>
                    <div class="col">
                        <label class="form-label">Class</label>
                        <input type="text" id="class" name="class" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Passing Marks</label>
                    <input type="number" id="passing_marks" name="passing_marks" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <!-- Grading Table -->
        <div class="card p-4">
            <h5 class="fw-bold">Grading</h5>
            <table class="table table-bordered" id="GradeTable">
                <thead class="table-warning">
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- Add Grade Section -->
        <div class="card p-4 mt-4">
            <h5 class="fw-bold">Add Grade</h5>
            <form id="gradeForm">
                @csrf
                <input type="hidden" id="gradeId" name="id">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">From</label>
                        <input type="number" id="from" name="from" class="form-control">
                    </div>
                    <div class="col">
                        <label class="form-label">To</label>
                        <input type="number" id="to" name="to" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Grade</label>
                    <input type="text" id="grade" name="grade" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection

   