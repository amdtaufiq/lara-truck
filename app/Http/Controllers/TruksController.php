<?php

namespace App\Http\Controllers;

use App\Truk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TruksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $truks = Truk::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Truk',
            'data' => $truks
        ], 200);
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
            'model_truk'     => 'required',
            'plat_nomor'     => 'required|unique:truks',
        ],
            [
                'model_truk.required' => 'Masukkan Model Truk !',
                'plat_nomor.required' => 'Masukkan Plat Nomor Truk !',
                'plat_nomor.unique'   => 'Nomor Plat sudah ada !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $truk = Truk::create([
                'model_truk'     => $request->input('model_truk'),
                'plat_nomor'   => $request->input('plat_nomor')
            ]);


            if ($truk) {
                return response()->json([
                    'success' => true,
                    'message' => 'Truk Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Truk Gagal Disimpan!',
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
        $truk = Truk::whereId($id)->first();

        if ($truk) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Truk!',
                'data'    => $truk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Truk Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
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
            'model_truk'   => 'required',
            'plat_nomor'   => 'required|unique:truks',

        ],
            [
                'model_truk.required' => 'Masukkan Model Truk !',
                'plat_nomor.required' => 'Masukkan Plat Nomor Truk !',
                'plat_nomor.unique'   => 'Nomor Plat sudah ada !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $truk = Truk::whereId($request->input('id'))->update([
                'model_truk'   => $request->input('model_truk'),
                'plat_nomor'   => $request->input('plat_nomor'),
            ]);


            if ($truk) {
                return response()->json([
                    'success' => true,
                    'message' => 'Truk Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Truk Gagal Diupdate!',
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
        $truk = Truk::findOrFail($id);
        $truk->delete();

        if ($truk) {
            return response()->json([
                'success' => true,
                'message' => 'Truk Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Truk Gagal Dihapus!',
            ], 500);
        }
    }
}
