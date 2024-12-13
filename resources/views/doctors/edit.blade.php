@extends('Layouts.Base')
@section('content')
<div class="container px-4">
    <h1 class="mt-4">Update Data Dokter</h1>
    <div class="card mb-4">
        <div class="card-body">
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" required>
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Spesialisasi</label>
            <input type="text" class="form-control" id="specialization" name="specialization" value="{{ $doctor->specialization }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{ $doctor->phone }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $doctor->email }}" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
                @if ($doctor->foto)
        <div class="mb-2">
            <img src="{{ asset('uploads/dokter/' . $doctor->foto) }}" class="img-thumbnail" style="width: 150px;">
        </div>
                @endif
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Update</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-danger btn-sm">Kembali</a>
    </form>
@endsection

