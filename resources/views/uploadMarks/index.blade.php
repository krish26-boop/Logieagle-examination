@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Exam Module Section -->
        <div class="card p-4 mb-4">
            <h4 class="fw-bold">Upload Marks File</h4>
        </div>

        <div class="card p-4 mb-4">
            <form id="importForm" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" />
                <button type="submit" class="btn btn-success">Import Excel</button>
                <a href="{{ url('/') }}" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
    @endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#importForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Create a FormData object to handle file data

            $.ajax({
                url: '{{ route("uploadMarks") }}', // Your route to the controller method
                type: 'POST',
                data: formData,
                processData: false, // Do not process data
                contentType: false, // Do not set content type
                success: function(response) {
                    $('#responseMessage').html('<p>' + response.message + '</p>'); // Show success message
                },
                error: function(xhr, status, error) {
                    var err = xhr.responseJSON;
                    $('#responseMessage').html('<p>Error: ' + err.message + '</p>'); // Show error message
                }
            });
        });
    </script>
</body>

</html>