@extends('Layouts.Base')
@section('content')
    <div class="container mt-4">
        <div class="mb-3">
            <form action="{{ route('doctors.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari dokter..." value="{{ $searchTerm ?? '' }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
        <a href="{{ route('doctors.create') }}" class="btn btn-primary btn-sm mb-3">Tambah dokter</a>
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Daftar Dokter</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Spesialisasi</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($doctors as $doctor)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->specialization }}</td>
                                <td>{{ $doctor->phone }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>
                                    @if ($doctor->foto)
                                        <img src="{{ asset('uploads/dokter/' . $doctor->foto) }}"                                                                                         
                                            style="width: 105px; height: 135px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                    </td>
                                <td>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data dokter ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
