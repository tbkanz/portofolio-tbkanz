@extends('layouts.admin')

@section('content')
    <h1>Edit Project</h1>

    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Pesan sukses atau error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Judul -->
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="form-group">
        <label for="tanggalpembuatan">Tanggal Pembuatan</label>
        <input type="date" id="tanggalpembuatan" name="tanggalpembuatan" class="form-control" required>
    </div>

        <!-- Gambar -->
        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>

        <!-- Tampilkan gambar lama -->
        @if($project->image)
            <div class="form-group">
                <label>Gambar Saat Ini:</label><br>
                <img src="{{ asset('storage/' . $project->image) }}" alt="Gambar Project" style="width: 200px; height: auto;">
            </div>
        @endif

        <!-- Tombol submit -->
        <button type="submit" class="btn btn-success">Update Project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
