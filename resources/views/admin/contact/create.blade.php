@extends('layouts.admin')

@section('content')
<h1>Tambah Kontak Baru</h1>

<form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="instagram">Instagram</label>
        <textarea name="instagram" id="instagram" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="phone_number">Nomor Handphone</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
