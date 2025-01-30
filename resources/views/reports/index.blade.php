@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Examination Report</h2>

        <!-- Filters -->
        <form action="{{ route('reports.index') }}" method="GET" id="filter-form">
        <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-control">
                        <option>Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control">
                        <option>Select Exam</option>
                        @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-3">
                <a  href="{{ url('/') }}" class="btn btn-danger">Back</a>
                </div>

            </div>
        </form>

        <!-- Report Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marks as $mark)
                <tr>
                    <td> {{ $mark->student->name}}</td>
                    <td>{{ $mark->student->class}}</td>
                    <td>{{ $mark->student->section}}</td>
                    <td>{{ $mark->subject}}</td>
                    <td>{{ $mark->marks}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection
