<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

use App\Models\Type;
use App\Models\Process;

class OlahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.process.index', [
            'title' => 'Daftar Aneka Olahan',
            'types' => Type::all(),
            'processes' => Process::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('dashboard.process.create', [
            'title' => 'Tambah Olahan',
            'type' => Type::find($id)
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
        $proc = $request->all();
        $proc['id'] = $request->id;
        $validated = Validator::make($proc, [
            'id' => 'required|exists:types,id|max:255',
            'process' => 'required|unique:processes,nama|max:255',
            'desc' => 'required',
            'imageOlahan' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'id.exists' => 'Jenis olahan tidak di temukan.',
            'process.unique' => ':attribute telah digunakan',
            'process.required' => ':attribute tidak boleh kosong',
            'desc.required' => ':attribute tidak boleh kosong',
            'imageOlahan.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageOlahan.max' => 'image size maximal 2MB',
        ]);

        if ($validated->fails()) return redirect()->route('process.create', $proc['id'])->withErrors($validated)->withInput();

        Process::create([
            'nama' => $proc['process'],
            'no_jenis' => $proc['id'],
            'desc' => $proc['desc'],
            'image' => Str::replace('public/img/', '', $proc['imageOlahan']->store('public/img'))
        ]);

        $request->session()->flash('status', "Olahan $proc[process] Berhasil Di Tambahkan");
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
        $process = Process::find($id);

        return view('process.details', [
            'process' => $process,
            'processes' => Process::where('no_jenis', $process->no_jenis)->get()
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
        $proc = Process::find($id);
        if (!$proc) return abort(404);
        $ty = Type::find($proc->no_jenis);

        return view('dashboard.process.update', [
            'title' => 'Edit Olahan',
            'process' => $proc,
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
        $proc = $request->all();
        $proc['id'] = $id;
        $validated = Validator::make($proc, [
            'id' => 'required|exists:processes,id|max:255',
            'process' => "required|unique:processes,nama,$id|max:255",
            'desc' => 'required',
            'imageOlahan' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'id.exists' => 'Hmmmm.',
            'process.required' => 'nama olahan tidak boleh kosong.',
            'process.unique' => 'nama olahan sudah di gunakan.',
            'desc.required' => ':attribute tidak boleh kosong',
            'imageOlahan.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageOlahan.max' => 'image size maximal 2MB',
        ]);

        if ($validated->fails()) return redirect()->route('process.edit', $id)->withErrors($validated)->withInput();

        $chunk = [
            'nama' => $proc['process'],
            'desc' => $proc['desc']
        ];

        if (Arr::exists($proc, 'imageOlahan')) {
            Storage::delete("public/img/" . Process::find($id)->image);
            $chunk['image'] = Str::replace('public/img/', '', $proc['imageOlahan']->store('public/img'));
        }

        Process::where('id', $id)->update($chunk);
        $request->session()->flash('status', "Olahan $proc[process] Berhasil Di Update");
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
            'id' => 'required|exists:processes,id|max:255'
        ], [
            'id.exists' => 'Menu Olahan tidak di temukan.'
        ]);

        if ($validated->fails()) return redirect()->route('process.index', $id)->withErrors($validated)->withInput();

        $proc = Process::find($id);
        Storage::delete("public/img/$proc->image");

        Process::destroy($id);
        $request->session()->flash('status', "Menu Olahan Berhasil Di Hapus");
        return redirect()->route('process.index');
    }
}
