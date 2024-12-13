<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAboutController extends Controller
{

    // Menampilkan daftar data about
    public function index()
    {
        $abouts = About::all(); // Ambil semua data about
        return view('admin.about.index', compact('abouts')); // Kirim data ke view
    }

    // Menampilkan form untuk membuat data about baru
    public function create()
    {
        return view('admin.about.create'); // Menampilkan form untuk menambah data
    }

    // Menyimpan data about baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        // Simpan data baru ke dalam database
        About::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('about.index')->with('success', 'Data About berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data about
    public function edit($id)
    {
        $about = About::findOrFail($id); // Cari data berdasarkan id
        return view('admin.about.edit', compact('about')); // Kirim data ke view
    }

    // Menyimpan perubahan data about ke database
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        // Cari dan update data about
        $about = About::findOrFail($id);
        $about->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('about.index')->with('success', 'Data About berhasil diupdate!');
    }

    // Menghapus data about
    public function destroy($id)
    {
        // Cari dan hapus data about
        $about = About::findOrFail($id);
        $about->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('about.index')->with('success', 'Data About berhasil dihapus!');
    }
}
