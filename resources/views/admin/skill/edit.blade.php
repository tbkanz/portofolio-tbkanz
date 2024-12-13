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

<form action="{{ route('skills.update', $skill->id) }}" method="POST" onsubmit="return confirmUpdate(event)">
    @csrf
    @method('PUT') <!-- Menunjukkan bahwa ini adalah permintaan PUT untuk update -->
    <div class="form-group">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title', $skill->title) }}"
            placeholder="Enter title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" placeholder="Enter Description"
            required>{{ old('description', $skill->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="file">Upload File:</label>
        <input type="file" id="file" name="file" accept=".pdf,.jpg,.png" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-info">Update</button>
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
