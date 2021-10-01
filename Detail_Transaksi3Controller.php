<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail_Transaksi3;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Detail_Transaksi3Controller extends Controller
{
    public function show()
    {
        $data = DB::table('detail_transaksi3')
            ->join('transaksi3', 'detail_transaksi3.id_transaksi3', '=', 'transaksi3.id_transaksi3')
            ->join('produk3', 'detail_transaksi3.id_produk3', '=', 'produk3.id_produk3')
            ->select('transaksi3.id_transaksi3', 'transaksi3.tgl_transaksi', 'produk3.nama_produk', 'detail_transaksi3.qty', 'detail_transaksi3.subtotal')
            ->get();
        return Response()->json($data);
    }

    public function detail($id)
    {
    if(Detail_Transaksi3::where('id_detail_transaksi3', $id)->exists()) {
    $data = DB::table('detail_transaksi3')
           ->join('transaksi3', 'detail_transaksi3.id_transaksi3', '=', 'transaksi3.id_transaksi3')
           ->join('produk3', 'detail_transaksi3.id_produk3', '=', 'produk3.id_produk3')
           ->select('transaksi3.id_transaksi3', 'transaksi3.tgl_transaksi', 'produk3.nama_produk', 'detail_transaksi3.qty', 'detail_transaksi3.subtotal')
           ->where('detail_transaksi3.id_detail_transaksi3', '=', $id)
           ->get();
    return Response()->json($data);
   }
    else {
     return Response()->json(['message' => 'Tidak ditemukan' ]);
}
}
    public function store(Request $request)
    {
    $validator=Validator::make($request->all(),
    [
    'id_transaksi3' => 'required',
    'id_produk3' => 'required',
    'qty' => 'required'
    ]
    );

    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
   
    $id_produk3 = $request->id_produk3;
    $qty = $request->qty;
    $harga = DB::table('produk3')->where('id_produk3', $id_produk3)->value('harga');
    $subtotal = $harga * $qty;

    $simpan = Detail_Transaksi3::create([
    'id_transaksi3' => $request->id_transaksi3,
    'id_produk3' => $id_produk3,
    'qty' => $qty,
    'subtotal' => $subtotal
    ]);

    if($simpan) {
    return Response()->json(['status'=>1]);
    }
    else {
    return Response()->json(['status'=>0]);
    }
    }

    public function update($id, Request $request)  {
        $validator=Validator::make($request->all(),
        [
        'id_transaksi3' => 'required',
        'id_produk3' => 'required',
        'qty' => 'required',
        'subtotal' => 'required'
        ]);
       
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
       
        $ubah = Detail_Transaksi3::where('id_detail_transaksi3', $id)->update([
        'id_transaksi3' => $request->id_transaksi3,
        'id_produk3' => $request->id_produk3,
        'qty' => $request->qty,
        'subtotal' => $request->subtotal
        ]);
        if($ubah) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
       }
    }
    
    
