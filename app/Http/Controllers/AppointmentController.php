<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function search(Request $request){
    $searchTerm = $request->input('search');

    // Query untuk pencarian berdasarkan nama pasien, dokter, atau status
    $appointments = Appointment::query()
        ->where('name', 'LIKE', "%{$searchTerm}%")
        ->orWhereHas('doctor', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('specialization', 'LIKE', "%{$searchTerm}%");
        })
        ->orWhere('status', 'LIKE', "%{$searchTerm}%")
        ->get();

    // Kirim hasil pencarian ke view dengan kata kunci yang dicari
    return view('appointments.index', compact('appointments', 'searchTerm'));
    }


    public function deskripsi()
    {
        $appointments = Appointment::all();
        return view('deskripsi.deskripsi', compact('appointments'));
    }


    public function create()
    {
        $doctors = Doctor::all(); // Ambil semua data dokter
        return view('user.input', compact('doctors')); // Kirim data ke view
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'phone' => 'required|string|max:15',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date', // Validasi untuk tanggal dan waktu
            'foto' => 'nullable|image|max:2048', // Validasi untuk file foto
        ]);
    
        try {
            $data = $request->all();
    
            // Simpan file foto jika ada
            if ($request->hasFile('foto')) {
                $fileName = time() . '_' . $request->foto->getClientOriginalName();
                $request->foto->move(public_path('uploads/jadwal'), $fileName);
                $data['foto'] = $fileName;
            }
    
            // Tambahkan default status sebagai 'Pending'
            $data['status'] = 'Pending';
    
            // Simpan data ke database
            Appointment::create($data);
    
            return redirect()->route('user.input')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('user.input')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    
    public function markAsComplete($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->status = 'Completed';
            $appointment->save();

            return response()->json(['success' => 'Status berhasil diubah menjadi Completed']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function markAsCancel($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->status = 'Cancelled';
            $appointment->save();

            return response()->json(['success' => 'Status berhasil diubah menjadi Cancelled']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
    
            // Hapus foto jika ada
            if ($appointment->foto && file_exists(public_path('uploads/jadwal/' . $appointment->foto))) {
                unlink(public_path('uploads/jadwal/' . $appointment->foto));
            }
    
            $appointment->delete();
    
            return redirect()->route('appointments.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('appointments.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
