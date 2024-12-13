<?php

namespace App\Http\Controllers;
use App\Models\Doctor;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
     public function index(){
         $doctors = Doctor::all();
         return view('doctors.index', compact('doctors'));
     }

     public function search(Request $request){
         $searchTerm = $request->input('search');
     
         // Query pencarian
         $doctors = Doctor::query()
             ->where('name', 'LIKE', "%{$searchTerm}%")
             ->orWhere('specialization', 'LIKE', "%{$searchTerm}%")
             ->orWhere('phone', 'LIKE', "%{$searchTerm}%")
             ->orWhere('email', 'LIKE', "%{$searchTerm}%")
             ->get();
     
         // Tampilkan hasil pencarian
        return view('doctors.index', compact('doctors', 'searchTerm'));
    }
     
     public function create(){
         return view('doctors.create');
     }
 
     public function store(Request $request)
{
    $request->validate([
        
        'foto' => 'nullable|image|max:2048', // Validasi foto (opsional, maksimum 2MB)
    ]);

    $data = $request->all();

    // Simpan foto jika ada
    if ($request->hasFile('foto')) {
        $fileName = time() . '_' . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('uploads/dokter'), $fileName); // Simpan file di folder public/uploads/doctors
        $data['foto'] = $fileName; // Simpan nama file ke database
    }

    Doctor::create($data);

    return redirect()->route('doctors.index')->with('success', 'Dokter berhasil ditambahkan.');
}

     public function edit($id){
         $doctor = Doctor::findOrFail($id);
         return view('doctors.edit', compact('doctor'));
     }
 
     // Memperbarui data dokter
     public function update(Request $request, $id)
     {
         $request->validate([             
             'foto' => 'nullable|image|max:2048', // Validasi foto
         ]);
     
         $doctor = Doctor::findOrFail($id);
         $data = $request->all();
     
         // Simpan foto baru jika ada, dan hapus foto lama
         if ($request->hasFile('foto')) {
             // Hapus foto lama jika ada
             if ($doctor->foto && file_exists(public_path('uploads/dokter/' . $doctor->foto))) {
                 unlink(public_path('uploads/dokter/' . $doctor->foto));
             }
     
             $fileName = time() . '_' . $request->foto->getClientOriginalName();
             $request->foto->move(public_path('uploads/dokter'), $fileName);
             $data['foto'] = $fileName; // Update nama file di database
         }
     
         $doctor->update($data);
     
         return redirect()->route('doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
     }
     
     // Menghapus data dokter
     public function destroy($id)
     {
         $doctor = Doctor::findOrFail($id);
     
         // Hapus foto jika ada
         if ($doctor->foto && file_exists(public_path('uploads/dokter/' . $doctor->foto))) {
             unlink(public_path('uploads/dokter/' . $doctor->foto));
         }
     
         $doctor->delete();
     
         return redirect()->route('doctors.index')->with('success', 'Dokter berhasil dihapus.');
     }
     
}
