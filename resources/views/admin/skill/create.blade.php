@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <script>
        Swal.fire({
            title: 'Error!',
            text: 'Please fix the following errors:',
            icon: 'error',
            html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

<form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleSubmit(event)">
    @csrf <!-- Pastikan untuk menambahkan token CSRF -->
    <div class="form-group">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    function handleSubmit(event) {
    event.preventDefault(); // Mencegah pengiriman form sementara

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
            event.target.submit(); // Submit form jika dikonfirmasi
        }
    });
}

</script>
@endsection
