@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmUpdate(event)">
    @csrf
    @method('PUT') <!-- Menunjukkan bahwa ini adalah permintaan PUT untuk update -->
    
    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $certificate->name) }}" placeholder="Enter Name" required>
    </div>

    <div class="mb-3">
        <label for="issued_by" class="form-label">Issued by:</label>
        <input type="text" class="form-control" name="issued_by" value="{{ old('issued_by', $certificate->issued_by) }}" placeholder="Enter Issuer Name" required>
    </div>

    <div class="mb-3">
        <label for="issued_at">Issued at:</label>
        <input type="date" id="issued_at" name="issued_at" class="form-control" value="{{ old('issued_at', $certificate->issued_at) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" name="description" placeholder="Enter Description" required>{{ old('description', $certificate->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="file">Upload File:</label>
        <input type="file" id="file" name="file" accept=".pdf,.jpg,.png" class="form-control">
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate(event) {
        event.preventDefault(); // Mencegah form submit langsung

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Melanjutkan submit form jika konfirmasi diterima
            }
        });
    }
</script>
@endsection
