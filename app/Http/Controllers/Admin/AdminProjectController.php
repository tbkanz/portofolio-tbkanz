<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProjectController extends Controller
{
    
    // Menampilkan daftar project
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    // Menampilkan form untuk membuat project baru
    public function create()
    {
        return view('admin.project.create');
    }

    // Menyimpan project baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tanggalpembuatan' => 'required|date',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('project', 'public');

        Project::create([
            'image' => $imagePath,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'tanggalpembuatan' => $validated['tanggalpembuatan'],
        ]);

        return redirect()->route('project.index')->with('success', 'Project berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    // Update project
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tanggalpembuatan' => 'required|date',
        ]);

        $project = Project::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->image = $imagePath;
        }

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'tanggalpembuatan' => $validated['tanggalpembuatan'],
        ]);

        return redirect()->route('project.index')->with('success', 'Project berhasil diupdate!');
    }

    // Hapus project
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project berhasil dihapus!');
    }
}
