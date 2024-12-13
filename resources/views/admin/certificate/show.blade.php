@extends('layouts.admin')

@section('content')
<h1>Certificate Details</h1>

<div class="card">
    <div class="card-body">
        <h3>Name: {{ $certificate->name }}</h3>
        <p><strong>Issued By:</strong> {{ $certificate->issued_by }}</p>
        <p><strong>Issued At:</strong> {{ $certificate->issued_at }}</p>
        <p><strong>Description:</strong> {{ $certificate->description }}</p>

        @if ($certificate->file)
            <div>
                <h4>Certificate File:</h4>
                @if (in_array(pathinfo($certificate->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/public/' . $certificate->file) }}" alt="Certificate Image"
                        style="max-width: 100%; height: auto;">
                @else
                    <a href="{{ asset('storage/public/' . $certificate->file) }}" class="btn btn-success">Download Certificate</a>
                @endif
            </div>
        @else
            <span>No File Uploaded</span>
        @endif

    </div>
</div>

<a href="{{ route('certificates.index') }}" class="btn btn-primary mt-3">Back to Certificates List</a>
@endsection
