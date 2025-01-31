@extends('Layouts.Base')
@section('content')
<form action="{{ route('appointments.search') }}" method="GET" class="d-flex mt-3">
    <input type="text" name="search" class="form-control me-2" placeholder="Cari pasien, dokter, atau status..." value="{{ $searchTerm ?? '' }}">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Pasien dan Jadwal</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>                            
                            <th>Pasien</th>
                            <th>Alamat</th>
                            <th>Jenis kelamin</th>
                            <th>Telepon</th>
                            <th>Dokter</th>                            
                            <th>Waktu ingin Konsultasi</th>
                            <th>Foto</th>
                            <th>Status</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>                           
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->alamat }}</td>
                            <td>{{ $appointment->jenis_kelamin }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>
                                {{ optional($appointment->doctor)->name ?? 'Tidak ditemukan' }}
                                @if ($appointment->doctor && $appointment->doctor->specialization)
                                ({{ $appointment->doctor->specialization }})
                                @endif
                            </td>                            
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y H:i') }}</td>
                            <td>
                                @if ($appointment->foto)
                                    <img src="{{ asset('uploads/jadwal/' . $appointment->foto) }}"                                                                          
                                    style="width: 105px; height: 135px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                @if($appointment->status == 'Pending') bg-warning 
                                @elseif($appointment->status == 'Completed') bg-success 
                                @else bg-danger @endif">
                                    {{ $appointment->status }}
                                </span>
                            </td>                           
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data janji temu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('layouts.scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('layouts.styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@endsection

<style>
    .table {
    white-space: nowrap;
}

</style>