<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Keranjang;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $keranjangIds = $request->keranjang_id;

        if (!$keranjangIds || !is_array($keranjangIds)) {
            return redirect()->route('keranjang.index')->with('error', 'Pilih produk terlebih dahulu!');
        }

        $keranjangs = Keranjang::whereIn('id', $keranjangIds)
            ->where('user_id', Auth::id())
            ->with('productCart')
            ->get();

        return view('pages.user.checkout', compact('keranjangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'c_phone' => 'required',
            'c_address' => 'required',
            'c_postal_zip' => 'required',
            'metode_pembayaran' => 'required|in:transfer_bank,dompet_digital,greai_offline',
        ]);

        $user = Auth::user();
        $keranjangs = Keranjang::where('user_id', $user->id)->with('productCart')->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong.');
        }

        DB::transaction(function () use ($request, $user, $keranjangs) {
            $totalHarga = $keranjangs->sum('total');

            $order = Checkout::create([
                'user_id' => $user->id,
                'phone' => $request->c_phone,
                'address' => $request->c_address,
                'postal_code' => $request->c_postal_zip,
                'notes' => $request->c_order_notes,
                'total_price' => $totalHarga,
                'payment_method' => $request->metode_pembayaran,
            ]);

            foreach ($keranjangs as $item) {
                OrderItem::create([
                    'checkout_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->qty,
                    'price' => $item->productCart->harga,
                ]);
            }

            Keranjang::where('user_id', $user->id)->delete();
        });

        return redirect()->route('pages.user.thankyou')->with('success', 'Pesanan kamu berhasil dibuat!');
    }
}
