@extends('Layouts.Base')
@section('content')
<title>Tambah Data Dokter</title>
<div class="container">
<h1 class="mt-4">Tambah Data Dokter</h1>
        <div class="card">
            <div class="card-body">
            <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Spesialisasi</label>
            <input type="text" class="form-control" id="specialization" name="specialization" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-danger btn-sm">Kembali</a>
    </form>
            </div>
        </div>
@endsection