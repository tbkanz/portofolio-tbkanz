@extends('layouts.admin')

@section('content')


<form action="{{ route('certificate.store') }}" method="POST" enctype="multipart/form-data"
    onsubmit="return handleSubmit(event)">
    @csrf
    <div class="form-group">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
    </div>
    <div class="mb-3">
        <label for="issued_by" class="form-label">Issued by:</label>
        <input type="text" class="form-control" name="issued_by" placeholder="Enter Issuer Name" required>
    </div>
    <div class="mb-3">
        <label for="issued_at">Issued at:</label>
        <input type="date" id="issued_at" name="issued_at" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
    </div>

    <div class="mb-3">
        <label for="file">Upload File:</label>
        <input type="file" id="file" name="file" accept=".pdf,.jpg,.png" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    function handleSubmit(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit the form?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>
@endsection