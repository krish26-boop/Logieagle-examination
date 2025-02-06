<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Exam Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const fetchExams = () => {
            $.ajax({
                url: "{{ route('exams.index') }}",
                type: "GET",
                success: function(response) {
                    let rows = '';
                    response.forEach(exam => {
                        rows += `
                                <tr>
                                    <td>${exam.id}</td>
                                    <td>${exam.exam_name}</td>
                                    <td>${exam.class}</td>
                                    <td>${exam.passing_marks}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="editExam(${exam.id})">Edit</button>
                                        <button class="btn btn-danger" onclick="deleteExam(${exam.id})">Delete</button>
                                    </td>
                                </tr>
                            `;
                    });
                    $('#ExamsTable tbody').html(rows);
                }
            });
        };

        const fetchGrades = () => {
            $.ajax({
                url: "{{ route('grades.index') }}",
                type: "GET",
                success: function(response) {
                    let rows = '';
                    response.forEach(grade => {
                        rows += `
                                <tr>
                                    <td>${grade.from}</td>
                                    <td>${grade.to}</td>
                                    <td>${grade.grade}</td>
                                    <td>
                                        <button class="btn btn-success" nclick="editGrade(${grade.id})">Edit</button>
                                        <button class="btn btn-danger" onclick="deleteGrade(${grade.id})">Delete</button>
                                    </td>
                                </tr>
                            `;
                    });
                    $('#GradeTable tbody').html(rows);
                }
            });
        };

        $(document).ready(function() {


            fetchExams();
            fetchGrades();

            $('#examForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#examId').val();
                const url = id ? `{{ url('exams') }}/${id}` : "{{ route('exams.store') }}";
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        fetchExams();
                        $('#examForm')[0].reset();
                        $('#examId').val('');
                    },
                    error: function(xhr) {
                        $('.error').remove();
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                const input = $('[name=' + field + ']');
                                const errorMessage = $('<span class="error" style="color:red;">' + messages[0] + '</span>');
                                input.after(errorMessage);
                            });
                        }
                    }
                });
            });

            $('#gradeForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#gradeId').val();
                const url = id ? `{{ url('grades') }}/${id}` : "{{ route('grades.store') }}";
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        fetchGrades();
                        $('#gradeForm')[0].reset();
                        $('#gradeId').val('');
                    },
                    error: function(xhr) {
                        $('.error').remove();
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                const input = $('[name=' + field + ']');
                                const errorMessage = $('<span class="error" style="color:red;">' + messages[0] + '</span>');
                                input.after(errorMessage);
                            });
                        }
                    }
                });
            });
        });


        const editExam = (id) => {
            $.ajax({
                url: `{{ url('exams') }}/${id}`,
                type: 'GET',
                success: function(exam) {
                    $('#examId').val(exam.id);
                    $('#exam_name').val(exam.exam_name);
                    $('#class').val(exam.class);
                    $('#passing_marks').val(exam.passing_marks);
                }
            });
        };

        const editGrade = (id) => {
            $.ajax({
                url: `{{ url('grades') }}/${id}`,
                type: 'GET',
                success: function(grade) {
                    $('#gradeId').val(grade.id);
                    $('#from').val(grade.from);
                    $('#to').val(grade.to);
                    $('#grade').val(grade.grade);
                }
            });
        };


        const deleteExam = (id) => {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: `{{ url('exams') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        fetchExams();
                        alert(response.message);
                    }
                });
            }
        };

        const deleteGrade = (id) => {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: `{{ url('grades') }}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        fetchGrades();
                        alert(response.message);
                    }
                });
            }
        };

        $('#importForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("uploadMarks") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    var err = xhr.responseJSON;
                    alert(err.message);
                }
            });
        });
    </script>
</body>

</html>