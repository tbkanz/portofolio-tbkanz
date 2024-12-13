<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class AdminCertificateController extends Controller
{
    // Menampilkan daftar semua sertifikat
    public function index()
    {
        $certificate = Certificate::all(); // Perbaikan: gunakan plural untuk koleksi data
        return view('admin.certificate.index', compact('certificate'));
    }

    // Menampilkan form untuk membuat sertifikat baru
    public function create()
    {
        return view('admin.certificate.create');
    }

    // Menyimpan data sertifikat baru ke database
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'issued_at' => 'required|date|before:2100-01-01|after:1900-01-01', // Validasi range tanggal
            'description' => 'required|string|max:5000', // Batasi panjang deskripsi jika diperlukan
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Validasi ukuran dan tipe file
        ]);

        $fileName = time() . '.' . $request->file('file')->extension();
        $filePath = $request->file('file')->storeAs('public', $fileName); // Simpan langsung di public/storage

        // Simpan hanya nama file di database
        $certificate = new Certificate();
        $certificate->name = $request->input('name');
        $certificate->issued_by = $request->input('issued_by');
        $certificate->issued_at = $request->input('issued_at');
        $certificate->description = $request->input('description');
        $certificate->file = $fileName;
        $certificate->save();

        session()->flash('success', 'Certificate has been created successfully.');

        return redirect()->route('certificate.index')->with('success', 'Certificate successfully saved!');
    }

    // Menampilkan detail sertifikat
    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificate.show', compact('certificate'));
    }

    // Menampilkan form untuk mengedit sertifikat
    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificate.edit', compact('certificate'));
    }

    // Memperbarui data sertifikat
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'issued_at' => 'required|date|before:2100-01-01|after:1900-01-01', // Validasi tanggal
            'description' => 'required|string|max:5000',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Validasi file
        ]);

        $certificate = Certificate::findOrFail($id);

        // Proses file jika ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($certificate->file) {
                Storage::disk('public')->delete($certificate->file);
            }
            // Simpan file baru
            $validatedData['file'] = $request->file('file')->store('certificate', 'public');
        }

        // Update data di database
        $certificate->update($validatedData);

        return redirect()->route('certificate.index')->with('success', 'Certificate successfully updated!');
    }

    // Menghapus sertifikat
    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);

        // Hapus file terkait
        if ($certificate->file) {
            Storage::disk('public')->delete($certificate->file);
        }

        // Hapus data dari database
        $certificate->delete();

        session()->flash('success', 'Certificate has been deleted successfully.');

        return redirect()->route('certificate.index')->with('success', 'Certificate successfully deleted!');
    }
}
