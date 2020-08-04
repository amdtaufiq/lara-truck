<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Item',
            'data' => $items
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
        $validator = Validator::make($request->all(), [
            'nama_item'     => 'required',
            'berat'         => 'required',
            'jumlah'        => 'required',
        ],
            [
                'nama_item.required'    => 'Masukkan Nama Barang !',
                'berat.required'        => 'Masukkan Berat Barang !',
                'jumlah.required'       => 'Masukkan Jumlah Barang !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $item = Item::create([
                'nama_item'     => $request->input('nama_item'),
                'berat'         => $request->input('berat'),
                'jumlah'        => $request->input('jumlah')
            ]);


            if ($item) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Item Gagal Disimpan!',
                ], 400);
            }
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
        $item = Item::whereId($id)->first();

        if ($item) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Item!',
                'data'    => $item
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item Tidak Ditemukan!',
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
        $validator = Validator::make($request->all(), [
            'nama_item'   => 'required',
            'berat'       => 'required',
            'jumlah'      => 'required',
        ],
            [
                'nama_item.required'    => 'Masukkan Nama Barang !',
                'berat.required'        => 'Masukkan Berat Barang !',
                'jumlah.required'       => 'Masukkan Plat Jumlah Barang !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $item = Item::whereId($request->input('id'))->update([
                'nama_item'     => $request->input('nama_item'),
                'berat'         => $request->input('berat'),
                'jumlah'        => $request->input('jumlah'),
            ]);


            if ($item) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Item Gagal Diupdate!',
                ], 500);
            }

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
        $item = Item::findOrFail($id);
        $item->delete();

        if ($item) {
            return response()->json([
                'success' => true,
                'message' => 'Item Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item Gagal Dihapus!',
            ], 500);
        }
    }
}
