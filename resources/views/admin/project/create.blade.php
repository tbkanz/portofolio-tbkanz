@extends('layouts.admin')

@section('content')

<h1>Tambah Project</h1>

<form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Gambar</label>
        <input type="file" id="image" name="image" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="tanggalpembuatan">Tanggal Pembuatan</label>
        <input type="date" id="tanggalpembuatan" name="tanggalpembuatan" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>

@endsection
