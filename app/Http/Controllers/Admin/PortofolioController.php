<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Certificate;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Contact;

class PortofolioController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        $certificates = Certificate::all();
        $projects = Project::all();
        $skills = Skill::all();
        $contacts = Contact::all();

        return view('admin.portofolio.index', compact('abouts', 'certificates', 'projects', 'skills', 'contacts'));
    }
}