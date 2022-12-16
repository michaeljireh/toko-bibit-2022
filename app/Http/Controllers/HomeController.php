<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\Process;
use App\Models\Type;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', [
            'menus' => Menu::all(),
            'types' => Type::all(),
            'processes' => Process::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrder()
    {
        $orders = [];

        foreach (Order::where('user_id', Auth::id())->get() as $order) {

            $orders[] = (object) [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'nama_penerima' => $order->nama_penerima,
                'telp_penerima' => $order->telp_penerima,
                'alamat_penerima' => $order->alamat_penerima,
                'waktu_kirim' => $order->waktu_kirim,
                'pesanan' => json_decode($order->pesanan),
                'type_pembayaran' => Payment::where('inisial', $order->type_pembayaran)->first(),
                'type_pengiriman' => Delivery::where('inisial', $order->type_pembayaran)->first(),
                'kadaluarsa' => $order->kadaluarsa,
                'bukti_pembayaran' => $order->bukti_pembayaran,
                'status' => Status::where('inisial', $order->status)->first(),
                'created_at' => $order->created_at
            ];
        }

        return view('order.index', [
            'orders' => $orders
        ]);
    }

    public function detailOrder($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return abort(404);
        }

        $lists = [];
        $total = 0;

        foreach (json_decode($order->pesanan) as $pesanan) {
            $menu = Menu::find($pesanan->menu_id);
            $total += $menu->harga * $pesanan->qty;
            $lists[] = (object) [
                'menu' => $menu,
                'qty' => $pesanan->qty
            ];
        }

        return view('order.details', [
            'id' => $order->id,
            'user_id' => $order->user_id,
            'nama_penerima' => $order->nama_penerima,
            'telp_penerima' => $order->telp_penerima,
            'alamat_penerima' => $order->alamat_penerima,
            'waktu_kirim' => $order->waktu_kirim,
            'pesanan' => json_decode($order->pesanan, true),
            'type_pembayaran' => Payment::where('inisial', $order->type_pembayaran)->first(),
            'type_pengiriman' => Delivery::where('inisial', $order->type_pengiriman)->first(),
            'kadaluarsa' => $order->kadaluarsa,
            'bukti_pembayaran' => $order->bukti_pembayaran,
            'status' => Status::where('inisial', $order->status)->first(),
            'created_at' => $order->created_at,
            'total' => $total,
            'lists' => $lists
        ]);
    }
}
