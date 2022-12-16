<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\Cart;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.menu.index', [
            'title' => 'Daftar Menu',
            'menus' => Menu::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.menu.create', [
            'title' => 'Tambah Menu',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu' => 'required|unique:menus,menu|max:255',
            'desc' => 'required',
            'harga' => 'required|integer',
            'imageMenu' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'menu.required' => ':attribute tidak boleh kosong',
            'menu.unique' => ':attribute telah digunakan',
            'harga.required' => ':attribute tidak boleh kosong',
            'harga.integer' => ':attribute harus angka',
            'desc.required' => ':attribute tidak boleh kosong',
            'imageMenu.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageMenu.max' => 'image size maximal 2MB',
        ]);

        Menu::create([
            'menu' => $validated['menu'],
            'harga' => $validated['harga'],
            'desc' => $validated['desc'],
            'image' => Str::replace('public/img/', '', $request->file('imageMenu')->store('public/img'))
        ]);

        $request->session()->flash('status', "Menu $validated[menu] Berhasil Di Tambahkan");
        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('menu.details', [
            'menu' => Menu::find($id),
            'menus' => Menu::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $mnu = Menu::find($id);
        if (!$mnu) return abort(404);

        return view('dashboard.menu.update', [
            'title' => 'Edit Menu',
            'menu' => $mnu
        ]);
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
        $mnu = $request->all();
        $mnu['id'] = $id;
        $validated = Validator::make($mnu, [
            'id' => 'required|exists:menus,id|max:255',
            'menu' => "required|unique:menus,menu,$id|max:255",
            'desc' => 'required',
            'harga' => 'required|integer',
            'imageMenu' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'id.exists' => 'Hmmmm.',
            'menu.required' => ':attribute tidak boleh kosong.',
            'menu.unique' => ':attribute sudah di gunakan.',
            'harga.required' => ':attribute tidak boleh kosong.',
            'harga.integer' => ':attribute harus angka.',
            'desc.required' => ':attribute tidak boleh kosong.',
            'imageMenu.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageMenu.max' => 'image size maximal 2MB',
        ]);

        if ($validated->fails()) return redirect()->route('menu.edit', $id)->withErrors($validated)->withInput();

        $chunk = [
            'menu' => $mnu['menu'],
            'harga' => $mnu['harga'],
            'desc' => $mnu['desc']
        ];

        if (Arr::exists($mnu, 'imageMenu')) {
            Storage::delete("public/img/" . Menu::find($id)->image);
            $chunk['image'] = Str::replace('public/img/', '', $mnu['imageMenu']->store('public/img'));
        }

        Menu::where('id', $id)->update($chunk);
        $request->session()->flash('status', "Menu $mnu[menu] Berhasil Di Update");
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|exists:menus,id|max:255'
        ], [
            'id.exists' => 'Menu Olahan tidak di temukan.'
        ]);

        if ($validated->fails()) return redirect()->route('menu.index', $id)->withErrors($validated)->withInput();

        $mnu = Menu::find($id);
        Storage::delete("public/img/$mnu->image");

        Menu::destroy($id);
        $request->session()->flash('status', "Menu Berhasil Di Hapus");
        return redirect()->route('menu.index');
    }
}
