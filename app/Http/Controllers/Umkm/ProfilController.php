<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkms = Umkm::with('userUmkm')->where('user_id', Auth::id())->get();
        $users = User::all();
        return view('pages.umkm.profil.index', ['umkms' => $umkms, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $umkm = Umkm::where('user_id', $user->id)->first();

        if (!$umkm) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses profil ini.');
        }

        return view('pages.umkm.profil.index', compact('user', 'umkm'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'deskripsi' => 'required|string',
            'logo' => 'nullable|mimetypes:image/*|max:4096',
        ]);

        $umkm = Umkm::find($id);

        if ($umkm) {
            $data = [
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'deskripsi' => $request->deskripsi
            ];

            if ($request->hasFile('logo')) {
                if ($umkm->logo && file_exists(public_path('uploads/logo/' . $umkm->logo))) {
                    unlink(public_path('uploads/logo/' . $umkm->logo));
                }

                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/logo'), $filename);
                $data['logo'] = $filename;
            }

            $umkm->update($data);
        } else {
            $data = [
                'user_id' => Auth::id(),
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'deskripsi' => $request->deskripsi
            ];

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/logo'), $filename);
                $data['logo'] = $filename;
            }

            Umkm::create($data);
        }

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
