<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkOut(Request $request, $id)
{
    $product = Product::where('id', $id)->first();
    $data =[
        'user_id' => auth()->id(), // Sesuaikan dengan autentikasi Anda
        'product_id' => $product->id,
        'status' => 'pending',
        'amount' => $product->price,
    ];
    $order = Transaction::create($data); 

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $order->amount,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            )

        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('product.checkOut',compact('snapToken','order'));

}
public function handleMidtransCallback(Request $request)
{
    // Ambil data respons dari Midtrans
    $response = $request->all();

    // Perbarui status transaksi jika pembayaran berhasil
    if ($response['transaction_status'] === 'settlement') {
        $transaction = Transaction::findOrFail($response['order_id']);
        $transaction->status = 'success'; // Ubah status transaksi menjadi sukses
        $transaction->save();
    }

    // Arahkan pengguna ke halaman riwayat pesanan
    return Redirect::route('orderHistory');
}

public function index()
{
    // Ambil data pesanan dari database
    $orders = \App\Models\Transaction::where('user_id', auth()->id())->get();
    
    // Tampilkan halaman riwayat pesanan dengan data pesanan
    return view('product.history', ['orders' => $orders]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
