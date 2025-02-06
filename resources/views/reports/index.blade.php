@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Examination Report</h2>

        <!-- Filters -->
        <form action="{{ route('reports.index') }}" method="GET" id="filter-form">
        <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-control" name="exam" id="exam">
                        <option value="">Select Exam</option>
                        @foreach ($exams as $exam)
                        <option value="{{ $exam }}">{{ $exam }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="class" id="class">
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{ $class }}">{{ $class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="section"  id="section">
                        <option value="">Select Section</option>
                        @foreach ($sections as $section)
                        <option value="{{ $section }}">{{ $section }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="grades[]" id="grade" multiple >
                        <option value="">Select Grade</option>
                        @foreach ($grades as $grade)
                        <option value="{{ $grade }}">{{ $grade }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mt-3" name="gender" id="gender">
                    <select class="form-control">
                        <option value="">Select Gender</option>
                        @foreach ($genders as $gender)
                        <option value="{{ $gender }}">{{ $gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="grade-condition">
                    <input type="radio" name="grade_condition" value="only" id="only" checked> Only
                    <input type="radio" name="grade_condition" value="above" id="above"> Above
                    <input type="radio" name="grade_condition" value="below" id="below"> Below
                </div>

                <div class="col-md-3 mt-3">
                    <button type="submit" class="btn btn-md btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-3  mt-3">
                <a  href="{{ url('/') }}" class="btn btn-danger">Back</a>
                </div>

            </div>
        </form>
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Grade</th>
            @foreach($subjects as $subject)
                <th>{{ $subject }}</th>
            @endforeach
            <th>Total</th>
            <th>% Pass</th>
        </tr>
    </thead>
    <tbody>
    @foreach($reportData as $grade => $data)
            <tr>
                <td>{{ $grade }}</td>
                @foreach($subjects as $subject)
                    <td>{{ $data[$subject] ?? 0 }}</td>
                @endforeach
                <td>{{ $data['Total'] }}</td>
                <td>{{ number_format($data['% Pass'], 2) }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>

      
    </div>
    <script>
    // JavaScript to handle grade condition selection
    const gradeSelect = document.getElementById('grade');
    const conditionRadios = document.getElementById('grade-condition');
    
    gradeSelect.addEventListener('change', function() {
        const selectedGrades = Array.from(gradeSelect.selectedOptions).map(option => option.value);
        if (selectedGrades.length > 1) {
            // If multiple grades selected, force "Only" condition
            document.getElementById('only').checked = true;
            conditionRadios.style.display = 'none'; // Hide other radio options
        } else {
            conditionRadios.style.display = 'block'; // Show all radio options
        }
    });

    // Trigger the change event on page load to handle default selected state
    gradeSelect.dispatchEvent(new Event('change'));
</script>
@endsection
