<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Illuminate\Support\Facades\DB;

class PrincipalController extends Controller
{
    public function index()
    {        
        return view('principal');
    }

    public function apresentacao()
    {
        return view('apresentacao');
    }

    public function instrucao()
    {
        return view('instrucao');
    }

    public function contato()
    {
        return view('contato');
    }

    public function libratos()
    {
        return view('libratos');
    }

    public function libror()
    {
        return view('libror');
    }

    public function unifrazinho()
    {
        return view('unifrazinho');
    }

    public function biblioteca()
    {
        return view('biblioteca');
    }

    public function links()
    {
        return view('links');
    }

    public function home()
    {
        $idiomas = DB::table('idioma')->where('status', '=', 'A')->orderBy('nome')->get();        
        $session = session('chat_users');

        return view('principal', compact('idiomas', 'session'));
    }
    
    /*public function index()
    {
        $barang = Barang::orderBy('name', 'asc')->get();

        return view('barang.barang', [
            'barang' => $barang
        ]);
    }*/

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.barang-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $barang = Barang::create($request->all());

        Alert::success('Success', 'Barang has been saved !');
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_barang)
    {
        $barang = barang::findOrFail($id_barang);

        return view('barang.barang-edit', [
            'barang' => $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_barang)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs,name,' . $id_barang . ',id_barang',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update($validated);

        Alert::info('Success', 'Barang has been updated !');
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        try {
            $deletedbarang = Barang::findOrFail($id_barang);

            $deletedbarang->delete();

            Alert::error('Success', 'Barang has been deleted !');
            return redirect('/barang');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Barang already used !');
            return redirect('/barang');
        }
    }
}
