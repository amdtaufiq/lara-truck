<?php

namespace App\Http\Controllers;

use App\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rental::latest()
        ->join('truks','truk_id', '=', 'truks.id')
        ->select('rentals.*', 'truks.model_truk', 'truks.plat_nomor')
        ->get();
        return response([
            'success' => true,
            'message' => 'List Semua Rentals',
            'data' => $rentals
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
            'nama_penyewa'  => 'required',
            'nomor'         => 'required|size:12',
            'durasi'        => 'required',
        ],
            [
                'nama_penyewa.required' => 'Masukkan Nama Penyewa Rental !',
                'nomor.required'        => 'Masukkan Nomor Rental !',
                'nomor.size'            => 'Nomor Harus 12 Angka !',
                'durasi.required'       => 'Masukkan Durasi Hari Rental !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $rental = Rental::create([
                'nama_penyewa'     => $request->input('nama_penyewa'),
                'nomor'            => $request->input('nomor'),
                'truk_id'          => $request->input('truk_id'),
                'durasi'           => $request->input('durasi')
            ]);


            if ($rental) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rental Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Rental Gagal Disimpan!',
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
        $rental = Rental::latest()
        ->join('truks','truk_id', '=', 'truks.id')
        ->select('rentals.*', 'truks.model_truk', 'truks.plat_nomor')
        ->where('rentals.id', $id)
        ->first();

        if ($rental) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Rental!',
                'data'    => $rental
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Rental Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

}
