<?php

namespace App\Jobs;

use App\Models\Skp;
use App\Models\SkpGuru;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetPangkatAndPejabatJob
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Skp::whereRaw('skp.perencanaan = CAST(now() as date)')->each(function ($skp) {
            if($skp->skpGurus){
                $skp->skpGurus->each(function ($skpGuru) use ($skp) {
                    $skpGuru->pejabat_rencana = $skp->pejabat_penilai->nip;
                    $skpGuru->pangkat_rencana = $skpGuru->user->pangkat_id;
                    $skpGuru->save();
                });
            }
        });
        Skp::whereRaw('skp.penilaian = CAST(now() as date)')->each(function ($skp) {
            if($skp->skpGurus){
                $skp->skpGurus->each(function ($skpGuru) use ($skp) {
                    $skpGuru->pejabat_nilai = $skp->pejabat_penilai->nip;
                    $skpGuru->pangkat_nilai = $skpGuru->user->pangkat_id;
                    $skpGuru->save();
                });
            }
        });
    }
}
