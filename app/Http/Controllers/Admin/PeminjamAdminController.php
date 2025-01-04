<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;

class PeminjamAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $peminjams = Peminjam::with('user')->get();
        return view('admin.layouts.pages.user.data-peminjam', compact('peminjams','users'))->with('title', 'Manajemen Peminjam');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Create peminjam
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|integer', // Province ID
            'kabupaten' => 'required|integer', // Regency ID
            'kecamatan' => 'required|integer', // District ID
            'phone' => 'required|string|max:15',
            'photo' => 'nullable|image',
            'email' => 'required|email',
        ]);

        // Menyimpan peminjam dengan data lokasi
        $locationData = [
            'provinsi_id' => $validated['provinsi'],
            'kabupaten_id' => $validated['kabupaten'],
            'kecamatan_id' => $validated['kecamatan'],
            'provinsi' => $request->input('provinsi_name'),
            'kabupaten' => $request->input('kabupaten_name'),
            'kecamatan' => $request->input('kecamatan_name'),
        ];

        // Membuat peminjam baru
        Peminjam::create([
            'user_id' => $validated['user_id'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'alamat' => $validated['alamat'],
            'location' => $locationData,
            'phone' => $validated['phone'],
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos') : null,
            'email' => $validated['email'],
        ]);

        // Redirect setelah peminjam berhasil dibuat
        return redirect()->route('admin.layouts.pages.data-peminjam')->with('success', 'Peminjam berhasil dibuat.');
    }

    // Mengambil data provinsi
    public function getProvinces()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        return response()->json($response->json());
    }

    // Mengambil kabupaten berdasarkan ID provinsi
    public function getKabupatenByProvinsi($provinsiId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinsiId}.json");
        return response()->json($response->json());
    }

    // Mengambil kecamatan berdasarkan ID kabupaten
    public function getKecamatanByKabupaten($kabupatenId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$kabupatenId}.json");
        return response()->json($response->json());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
