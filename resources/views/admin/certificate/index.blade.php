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

<h1>Data Certificate</h1>
<a href="{{ route('certificates.create') }}" class="btn btn-primary">Create</a>

<table id="mytable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Issued By</th>
            <th>Issued At</th>
            <th>Description</th>
            <th>File</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($certificate as $row) <!-- Corrected this part -->
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->issued_by }}</td>
                <td>{{ $row->issued_at }}</td>
                <td>{{ $row->description }}</td>
                <td>
                    @if ($row->file)
                        <!-- Memastikan file dapat diakses -->
                        <a href="{{ route('certificates.show', ['certificate' => $row->id]) }}" class="btn btn-info">View
                            Certificate</a>
                    @else
                        <span>No File Uploaded</span>
                    @endif
                </td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('certificates.edit', ['certificate' => $row->id]) }}" class="btn btn-warning">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('certificates.destroy', ['certificate' => $row->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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