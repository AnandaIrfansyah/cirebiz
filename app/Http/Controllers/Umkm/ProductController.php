<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('profilUmkm', 'kategori', 'userProduct')->where('user_id', Auth::id())->paginate(6);
        $profils = Umkm::all();
        $users = User::all();
        $kategoris = Kategori::all();
        return view('pages.umkm.produk.index', ['products' => $products, 'profils' => $profils, 'users' => $users, 'kategoris' => $kategoris]);
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->save();

        return response()->json(['succes' => 'Status berhasil diperbarui']);
    }

    public function create()
    {
        $products = Product::with('profilUmkm', 'kategori', 'userProduct')->get();
        $profils = Umkm::all();
        $users = User::all();
        $kategoris = Kategori::all();
        return view('pages.umkm.produk.create', ['products' => $products, 'profils' => $profils, 'users' => $users, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $umkm = $user->userUmkm;
        if (!$umkm) {
            return redirect()->back()->with('error', 'Anda belum memiliki UMKM.');
        }

        $request->validate([
            'nama_product' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto_product' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_product')) {
            $file = $request->file('foto_product');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product_images'), $filename);
        } else {
            $filename = null;
        }


        Product::create([
            'umkm_id' => $umkm->id,
            'user_id' => $user->id,
            'nama_product' => $request->nama_product,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto_product' => $filename,
            'status' => 'finished',
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }



    public function show(string $id) {}

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $profils = Umkm::all();
        $users = User::all();
        $kategoris = Kategori::all();

        return view('pages.umkm.produk.edit', compact('product', 'profils', 'users', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_product' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_product')) {
            $file = $request->file('foto_product');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product_images'), $filename);

            if ($product->foto_product && file_exists(public_path('uploads/product_images/' . $product->foto_product))) {
                unlink(public_path('uploads/product_images/' . $product->foto_product));
            }

            $product->foto_product = $filename;
        }

        $product->update([
            'nama_product' => $request->nama_product,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->foto_product && file_exists(public_path('uploads/product_images/' . $product->foto_product))) {
            unlink(public_path('uploads/product_images/' . $product->foto_product));
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus!');
    }
}
