@extends('layouts.admin')

@section('content')
<h1>Edit Kontak</h1>

<form action="{{ route('contacts.update', $contact->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email }}" required>
    </div>

    <div class="form-group">
        <label for="phone_number">Nomor Handphone</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $contact->phone_number }}" required>
    </div>

    <div class="form-group">
        <label for="instagram">instagram</label>
        <textarea name="instagram" id="instagram" class="form-control">{{ $contact->instagram }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
