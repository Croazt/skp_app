<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $skp_id
 * @property integer $kinerja_id
 * @property string $butir_kegiatan
 * @property string $output_kegiatan
 * @property integer $angka_kredit
 * @property string $pekerjaan
 * @property string $indikator_kualtias
 * @property string $indikator_kuantitas
 * @property string $indikator_waktu
 * @property string $detail_output_kualitas
 * @property string $detail_output_kuantitas
 * @property string $detail_output_waktu
 * @property Skp $skp
 * @property Kinerja $kinerja
 * @property RencanaKinerjaGuru[] $rencanaKinerjaGurus
 */
class DetailKinerja extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'detail_kinerja';

    /**
     * @var array
     */
    protected $fillable = ['skp_id', 'kinerja_id', 'butir_kegiatan', 'output_kegiatan', 'angka_kredit', 'pekerjaan', 'indikator_kualtias', 'indikator_kuantitas', 'indikator_waktu', 'detail_output_kualitas', 'detail_output_kuantitas', 'detail_output_waktu'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skp()
    {
        return $this->belongsTo('App\Models\Skp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kinerja()
    {
        return $this->belongsTo('App\Models\Kinerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rencanaKinerjaGurus()
    {
        return $this->hasMany('App\Models\RencanaKinerjaGuru');
    }
}
