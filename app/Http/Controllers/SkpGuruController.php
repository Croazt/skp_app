<?php

namespace App\Http\Controllers;

use App\Http\Requests\RencanaKinerjaGuruCreateRequest;
use App\Models\SkpGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkpGuruController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRencanaKinerjaGuru(RencanaKinerjaGuruCreateRequest $request,SkpGuru $skpGuru)
    {
        $skpGuru->rencanaKinerjaGurus()->create([
            'detail_kinerja_id' => $request->detail_kinerja_id,
            'user_nip' => Auth::user()->nip,
            'skp_id' => $skpGuru->skp_id
        ]);

        return response()->json([
            'message' => 'Tambah rencana kinerja sukses'
        ]);
    }

    
    public function rencanaPrint()
    {
        return view('livewire.skp-guru.pdf.skp-guru-rencana',[
            'rencanaKinerjaUtama' => request()->session()->get('rencanaKinerjaUtama'),
            'rencanaKinerjaTambahan' => request()->session()->get('rencanaKinerjaTambahan'),
            'data' => request()->session()->get('data'),
            'skpGuru' => request()->session()->get('skpGuru'),
            'skp' => request()->session()->get('skpGuru')->skp,
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
        //
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
