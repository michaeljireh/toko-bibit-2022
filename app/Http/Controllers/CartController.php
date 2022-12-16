<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Delivery;
use App\Models\Menu;
use App\Models\Payment;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout.index', [
            'carts' => Cart::where('user_id', Auth::id())->get(),
            'deliveries' => Delivery::all(),
            'payments' => Payment::all()
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
    public function store(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('menu_id', $id)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $id,
                'qty' => 0
            ]);
        }

        $cart = Cart::where('user_id', Auth::id())->where('menu_id', $id)->first();

        if ($request->query('qty')) {
            for ($i = 0; $i < $request->query('qty'); $i++) {
                $cart->increment('qty');
            }
        } else {
            $cart->increment('qty');
        }

        $carts = '';

        foreach (Cart::where('user_id', Auth::id())->get() as $cart) {
            $menu = Menu::find($cart->menu_id);

            // $carts[] = [
            //     'menu' => $menu->menu,
            //     'harga' => $menu->harga,
            //     'image' => $menu->image,
            //     'qty' => $cart->qty
            // ];

            $carts .= view('renders.cart-list', [
                'menu' => $menu,
                'cart' => $cart
            ])->render();
        }

        return $carts;
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
        $cart = Cart::where('user_id', Auth::id())->where('menu_id', $id)->first();
        if ($cart->increment('qty')) {
            return $cart->qty;
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('menu_id', $id)->first();
        if ($cart->decrement('qty')) {
            if ($cart->qty < 1) {
                Cart::destroy($cart->id);
                return 0;
            }
            return $cart->qty;
        } else {
            return abort(404);
        }
    }
}
