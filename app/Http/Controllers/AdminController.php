<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.admin', [
            'title' => 'Basic Information'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function report()
    {
        $orders = [];

        foreach (Order::all() as $order) {
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

            $orders[] = (object) [
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
            ];
        }

        return view('dashboard.report.index', [
            'title' => 'Laporan Keuangan',
            'orders' => $orders,
            'statuses' => Status::all()
        ]);
    }

    public function print()
    {
        $orders = [];
        $allTotal = 0;

        foreach (Order::all() as $order) {
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

            $allTotal += $total;

            $orders[] = (object) [
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
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->toDateString(),
                'total' => $total,
                'lists' => $lists
            ];
        }

        return view('renders.pdf-keuangan', [
            'orders' => $orders,
            'statuses' => Status::all(),
            'allTotal' => $allTotal
        ]);
    }
}
