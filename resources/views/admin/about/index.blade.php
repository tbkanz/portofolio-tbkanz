@extends('layouts.admin')

@section('content')

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

<h1>Data About</h1>
<a href="{{ route('abouts.create') }}" class="btn btn-primary mb-3">Tambah Data About</a>

<table id="mytable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($abouts as $about)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $about->nama }}</td>
                <td>{{ $about->jurusan }}</td>
                <td>
                    <a href="{{ route('abouts.edit', $about->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" style="display:inline;" onsubmit="return handleDelete(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Tambahkan library DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Tampilkan notifikasi sukses jika ada session 'success'
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    // Fungsi untuk konfirmasi hapus
    function handleDelete(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Apakah Anda ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }

    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#mytable').DataTable({
            paging: true, // Pagination aktif
            searching: true, // Fitur pencarian aktif
            ordering: true, // Pengurutan kolom aktif
            pageLength: 10, // Jumlah baris per halaman
            lengthMenu: [10, 25, 50, 100], // Pilihan jumlah baris per halaman
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>

@endsection
