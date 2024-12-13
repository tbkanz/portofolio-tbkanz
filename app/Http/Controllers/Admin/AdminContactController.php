<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    // Constructor tanpa middleware autentikasi
    public function __construct()
    {
        // Anda tidak perlu menambahkan middleware autentikasi di sini
        // karena form kontak akan diakses oleh semua orang
    }

    // Menampilkan daftar kontak
    public function index()
    {
        $contacts = Contact::all(); // Mengambil semua kontak dari database
        return view('admin.contact.index', compact('contacts')); // Mengembalikan tampilan dengan data kontak
    }

    // Menampilkan form untuk menambah kontak baru
    public function create()
    {
        return view('admin.contact.create'); // Mengembalikan tampilan form
    }

    // Menyimpan kontak baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'email' => 'required|email|unique:contacts,email',
            'phone_number' => 'required|string|max:15',
            'instagram' => 'nullable|string',
        ]);

        // Menyimpan data kontak baru ke database
        Contact::create($validated);

        // Redirect ke halaman kontak dengan pesan sukses
        return redirect()->route('contact.index')->with('success', 'Kontak berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit kontak
    public function edit($id)
    {
        $contact = Contact::findOrFail($id); // Menemukan kontak berdasarkan ID
        return view('admin.contact.edit', compact('contact')); // Mengembalikan tampilan form edit dengan data kontak
    }

    // Menyimpan perubahan kontak ke database
    public function update(Request $request, $id)
    {
        // Menemukan kontak berdasarkan ID
        $contact = Contact::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email|unique:contacts,email,' . $contact->id, // Cek email unik tetapi kecualikan kontak yang sedang diedit
            'phone_number' => 'required|string|max:15',
            'instagram' => 'nullable|string',
        ]);

        // Mengupdate data kontak
        $contact->update($validated);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('contact.index')->with('success', 'Kontak berhasil diperbarui!');
    }

    // Menghapus kontak
    public function destroy($id)
    {
        // Menemukan dan menghapus kontak berdasarkan ID
        $contact = Contact::findOrFail($id);
        $contact->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('contact.index')->with('success', 'Kontak berhasil dihapus!');
    }
}
