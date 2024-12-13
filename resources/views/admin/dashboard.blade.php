@extends('layouts.admin')

@section("content")
<div class="container mt-4">
    <h1>Welcome to Admin Dashboard</h1>
    <p>This is the admin panel where you can manage the system.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Manage Skills
                </div>
                <div class="card-body">
                    <p class="card-text">Manage All Skills Here.</p>
                    <a href="{{ route('skills.index') }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Manage Certificate
                </div>
                <div class="card-body">
                    <p class="card-text">Manage All Certificate Here.</p>
                    <a href="{{ route('certificates.index') }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Manage About
                </div>
                <div class="card-body">
                    <p class="card-text">Manage All About Here.</p>
                    <a href="{{ route('abouts.index') }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Manage Project
                </div>
                <div class="card-body">
                    <p class="card-text">Manage All Project Here.</p>
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Manage Contact
                </div>
                <div class="card-body">
                    <p class="card-text">Manage All Contact Here.</p>
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection