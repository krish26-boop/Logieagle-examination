<form action="{{ route('reports.index') }}" method="GET" id="filter-form">
    <label for="exam_name">Exam Name:</label>
    <select name="exam_name" id="exam_name">
        <option value="">Select Exam</option>
        @foreach ($exams as $exam)
            <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
        @endforeach
    </select>

    <label for="class">Class:</label>
    <select name="class" id="class">
        <option value="">Select Class</option>
        <!-- Dynamically populate class options -->
    </select>

    <label for="grade">Grade:</label>
    <select name="grade" id="grade">
        <option value="">Select Grade</option>
        <!-- Dynamically populate grade options -->
    </select>

    <button type="submit">Filter</button>
</form>
