<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Type;
use App\Models\Process;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jenis.create', [
            'title' => 'Tambah Jenis Aneka Olahan'
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
            'jenis' => 'required|unique:types,jenis|max:255'
        ], [
            'type.required' => ':attribute tidak boleh kosong.',
            'type.unique' => ':attribute telah digunakan',
            'type.max' => 'Maksimal :attribute 255 karakter',
        ]);

        Type::create([
            'jenis' => $validated['jenis']
        ]);

        $request->session()->flash('status', "Jenis Olahan $validated[jenis] Berhasil Di Tambahkan");

        return redirect()->route('process.index');
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
    public function edit(Request $request, $id)
    {
        $ty = Type::find($id);
        if (!$ty) return abort(404);

        return view('dashboard.jenis.update', [
            'title' => 'Edit Jenis Aneka Olahan',
            'type' => $ty
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
        $ty = $request->all();
        $ty['id'] = $id;

        $validated = Validator::make($ty, [
            'id' => 'required|exists:types,id|max:255',
            'type' => "required|unique:types,jenis,$id|max:255"
        ], [
            'id.exists' => 'Hmmmm.',
            'type.required' => 'nama jenis olahan tidak boleh kosong.',
            'type.unique' => 'nama jenis olahan sudah di gunakan.'
        ]);

        if ($validated->fails()) return redirect()->route('type.edit', $id)->withErrors($validated)->withInput();

        Type::where('id', $id)->update(['jenis' => $ty['type']]);
        $request->session()->flash('status', "Olahan $ty[type] Berhasil Di Update");
        return redirect()->route('process.index');
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
            'id' => 'required|exists:types,id|max:255'
        ], [
            'id.exists' => 'Jenis olahan tidak di temukan.'
        ]);

        if ($validated->fails()) return redirect()->route('process.index', $id)->withErrors($validated)->withInput();

        Process::where('no_jenis', $id)->delete();
        Type::destroy($id);

        $request->session()->flash('status', "Jenis Olahan Berhasil Di Hapus");
        return redirect()->route('process.index');
    }
}
