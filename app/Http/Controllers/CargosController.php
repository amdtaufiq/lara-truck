<?php

namespace App\Http\Controllers;

use App\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rental_id)
    {
        
        $cargos = Cargo::
        join('items','item_id', '=', 'items.id')
        ->join('rentals','rental_id', '=', 'rentals.id')
        ->join('truks','truk_id', '=', 'truks.id')
        ->select('cargos.*', 'items.nama_item', 'rentals.nama_penyewa', 'truks.model_truk')
        ->where('cargos.rental_id', $rental_id)
        ->get();
        return response([
            'success' => true,
            'message' => 'List Semua Cargo',
            'data' => $cargos
        ], 200);
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
        $cargo = Cargo::create([
            'rental_id'     => $request->input('rental_id'),
            'item_id'       => $request->input('item_id')
        ]);


        if ($cargo) {
            return response()->json([
                'success' => true,
                'message' => 'Cargo Berhasil Disimpan!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cargo Gagal Disimpan!',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = Cargo::whereId($id)->first();
        // join('items','item_id', '=', 'items.id')
        // ->join('rentals','rental_id', '=', 'rentals.id')
        // ->join('truks','truk_id', '=', 'truks.id')
        // ->select('cargos.*', 'items.nama_item', 'rentals.nama_penyewa', 'truks.model_truk')
        // ->where('cargos', $id)
        // ->get();

        if ($cargo) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Cargo!',
                'data'    => $cargo
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cargo Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
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
    public function update(Request $request)
    {
        $cargo = Cargo::whereId($request->input('id'))->update([
            'rental_id'     => $request->input('rental_id'),
            'item_id'      => $request->input('item_id')
        ]);


        if ($cargo) {
            return response()->json([
                'success' => true,
                'message' => 'Cargo Berhasil Diupdate!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cargo Gagal Diupdate!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->delete();

        if ($cargo) {
            return response()->json([
                'success' => true,
                'message' => 'Cargo Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cargo Gagal Dihapus!',
            ], 500);
        }
    }
}
