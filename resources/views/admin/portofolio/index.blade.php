@extends('layouts.dark')

@section('content')
<div class="container">
    <!-- About Section -->
    @foreach ($abouts as $about)
        <div class="section" id="about">
            <h2 class="text-center mb-4 mt-5 display-4">{{ $about->nama }}</h2>
            <p class="lead">{{ $about->jurusan }}</p>
        </div>
    @endforeach

    <!-- Skills Section -->
    @foreach ($skills as $skill)
        <div class="section" id="skills">
            <h2 class="text-center mb-4 display-4">Skills</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded hover-shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">{{ $skill->title }}</h5>
                            <p class="card-text">{{ $skill->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Projects Section -->
    @foreach ($projects as $project)
        <div class="section" id="projects">
            <h2 class="text-center mb-4 display-4">Projects</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded hover-shadow" data-bs-toggle="modal"
                        data-bs-target="#projectModal{{$project->id}}">
                        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top"
                            alt="{{ $project->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Certificates Section -->
    @foreach ($certificates as $certificate)
        <div class="section" id="certificates">
            <h2 class="text-center mb-4 display-4">Certificates</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded hover-shadow" data-bs-toggle="modal"
                        data-bs-target="#certificateModal{{$certificate->id}}">
                        <div class="card-body text-center">
                            <h5 class="card-title text-info">{{ $certificate->name }}</h5>
                            <img src="{{ asset('storage/public/' . $certificate->file) }}" alt="{{ $certificate->name }}"
                                class="img-fluid mb-3" width="100">
                            <p class="font-weight-bold">{{ $certificate->issued_by }}</p>
                            <p class="card-text">{{ $certificate->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Footer Section -->
@foreach ($contacts as $contact)
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center d-flex justify-content-center flex-column align-items-center">
        <h4 class="mb-4">Contact Me</h4> <!-- Menambahkan margin bawah -->
        <div class="d-flex justify-content-center">
            <div class="mx-4">
                <i class="fas fa-envelope"></i> {{ $contact->email }}
            </div>
            <div class="mx-4">
                <i class="fas fa-phone"></i> {{ $contact->phone_number }}
            </div>
            <div class="mx-4">
                <i class="fab fa-instagram"></i> {{ $contact->instagram }}
            </div>
        </div>
    </div>
</footer>


@endforeach

@endsection
