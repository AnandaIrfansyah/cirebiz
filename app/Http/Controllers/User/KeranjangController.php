<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjangs = Keranjang::where('user_id', Auth::id())->with('productCart')->paginate(5);
        return view('pages.user.keranjang', compact('keranjangs'));
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);

        if ($keranjang->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $keranjang->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
