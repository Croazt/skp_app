<?php

namespace App\Http\Controllers;

use App\Http\Requests\KinerjaCreateRequest;
use App\Models\DetailKinerja;
use App\Models\Kinerja;
use App\Models\Skp;
use App\Models\SkpGuru;
use App\Models\User;
use Illuminate\Http\Request;

class DetailKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Skp $skp)
    {
        $search = request()->search;
        $kategori = request()->kategori;

        if ($search == '') {
            $kinerjas = $skp->detailKinerjas()->select(['detail_kinerja.*', 'kinerja.kategori'])->leftJoin('kinerja','kinerja.id','detail_kinerja.kinerja_id')->where('kategori', $kategori)->limit(5)->get();
        } else {
            $kinerjas = $skp->detailKinerjas()->select(['detail_kinerja.*', 'kinerja.kategori'])->leftJoin('kinerja','kinerja.id','detail_kinerja.kinerja_id')->where('detail_kinerja.deskripsi', 'like', '%' . $search . '%')->where('kinerja.kategori', $kategori)->limit(5)->get();
        }
        $response = array();
        foreach ($kinerjas as $kinerja) {
            $response[] = array(
                "id" => $kinerja->id,
                "deskripsi" => $kinerja->deskripsi,
                "kategori" => $kinerja->kategori,
                "butir_kegiatan" => $kinerja->butir_kegiatan,
                "output_kegiatan" => $kinerja->output_kegiatan,
                "angka_kredit" => $kinerja->angka_kredit,
                "pekerjaan" => $kinerja->pekerjaan,
                "indikator_kualitas" => $kinerja->indikator_kualitas,
                "indikator_kuantitas" => $kinerja->indikator_kuantitas,
                "indikator_waktu" => $kinerja->indikator_waktu,
                "detail_output_kualitas" => $kinerja->detail_output_kualitas,
                "detail_output_kuantitas" => $kinerja->detail_output_kuantitas,
                "detail_output_waktu" => $kinerja->detail_output_waktu,
                "tipe_angka_kredit" => $kinerja->tipe_angka_kredit,
            );
        }

        return response()->json($response);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSkpGuruKinerja(Skp $skp, SkpGuru $skpGuru)
    {
        $search = request()->search;
        $kategori = request()->kategori;
        $existingKinerja = $skpGuru->rencanaKinerjaGurus->pluck('detail_kinerja_id');
        if ($search == '') {
            $kinerjas = $skp->detailKinerjas()->select(['detail_kinerja.*', 'kinerja.kategori'])->leftJoin('kinerja','kinerja.id','detail_kinerja.kinerja_id')->where('kategori', $kategori)->whereNotIn('detail_kinerja.id',$existingKinerja)->limit(5)->get();
        } else {
            $kinerjas = $skp->detailKinerjas()->select(['detail_kinerja.*', 'kinerja.kategori'])->leftJoin('kinerja','kinerja.id','detail_kinerja.kinerja_id')->where('detail_kinerja.deskripsi', 'like', '%' . $search . '%')->where('kinerja.kategori', $kategori)->whereNotIn('detail_kinerja.id',$existingKinerja)->limit(5)->get();
        }
        $response = array();
        foreach ($kinerjas as $kinerja) {
            $response[] = array(
                "id" => $kinerja->id,
                "deskripsi" => $kinerja->deskripsi,
                "kategori" => $kinerja->kategori,
                "butir_kegiatan" => $kinerja->butir_kegiatan,
                "output_kegiatan" => $kinerja->output_kegiatan,
                "angka_kredit" => $kinerja->angka_kredit,
                "pekerjaan" => $kinerja->pekerjaan,
                "indikator_kualitas" => $kinerja->indikator_kualitas,
                "indikator_kuantitas" => $kinerja->indikator_kuantitas,
                "indikator_waktu" => $kinerja->indikator_waktu,
                "detail_output_kualitas" => $kinerja->detail_output_kualitas,
                "detail_output_kuantitas" => $kinerja->detail_output_kuantitas,
                "detail_output_waktu" => $kinerja->detail_output_waktu,
                "tipe_angka_kredit" => $kinerja->tipe_angka_kredit,
            );
        }

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
        ]);


        return response()->json([
            'message' => 'register success'
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
