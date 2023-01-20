<?php

namespace App\Http\Controllers;

use App\Http\Requests\KinerjaCreateRequest;
use App\Models\Kinerja;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Skp $skp)
    {

        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKinerja(Skp $skp)
    {
        $search = request()->search;
        $kinerjas = [];

        if ($search == '') {
            $kinerjas = $skp->kinerjas()->limit(5)->get();
        } else {
            $kinerjas = $skp->kinerjas()->where('deskripsi', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($kinerjas as $kinerja) {
            $response[] = array(
                "id" => $kinerja->id,
                "text" => $kinerja->deskripsi
            );
        }
        //
        return response()->json($response);
    }

    public function getJabatan(Skp $skp)
    {
        $search = request()->search;
        $jabatan = array_merge(User::PEKERJAAN, User::TUGAS_TAMBAHAN);;

        if (!$search == '') {
            $jabatan = array_filter($jabatan, function ($item) use ($search) {
                if (stripos($item, $search) !== false) {
                    return true;
                }
                return false;
            });
        }

        $response = array();
        foreach ($jabatan as $jabatan) {
            $response[] = array(
                "id" => $jabatan,
                "text" => $jabatan
            );
        }
        //
        return response()->json($response);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KinerjaCreateRequest $request, Skp $skp)
    {
        $kinerja = $skp->kinerjas()->find($request->deskripsi);
        if (!$kinerja instanceof Kinerja) {
            $kinerja = $skp->kinerjas()->create([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
            ]);
        }
        $kinerja->detailKinerjas()->create([
            'deskripsi' => $request->detail_rencana,
            'skp_id' => $skp->id,
            'butir_kegiatan' => $request->butir_kegiatan,
            'output_kegiatan' => $request->output_kegiatan,
            'tipe_angka_kredit' => $request->tipe_angka_kredit,
            'angka_kredit' => $request->angka_kredit,
            'pekerjaan' => $request->jabatan,
            'indikator_kualitas' => $request->iki_kualitas,
            'indikator_kuantitas' => $request->iki_kuantitas,
            'indikator_waktu' => $request->iki_waktu,
            'detail_output_kualitas' => $request->target_output_kualitas,
            'detail_output_kuantitas' => $request->target_output_kuantitas,
            'detail_output_waktu' => $request->target_output_waktu,
        ]);


        return response()->json([
            'message' => 'Tambah kinerja sukses'
        ]);
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
}
