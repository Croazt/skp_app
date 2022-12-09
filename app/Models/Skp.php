<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $pengelola_kinerja
 * @property string $tim_angka_kredit
 * @property string $pejabat_penilai1
 * @property string $pejabat_penilai2
 * @property string $perencanaan
 * @property string $periode_awal
 * @property string $periode_akhir
 * @property string $penilaian
 * @property DetailKinerja[] $detailKinerjas
 * @property IndikatorPenilaianPerilaku[] $indikatorPenilaianPerilakus
 * @property Kinerja[] $kinerjas
 * @property PenilaianPerilakuGuru[] $penilaianPerilakuGurus
 * @property RencanaKinerjaGuru[] $rencanaKinerjaGurus
 * @property PejabatPenilai $pejabatPenilai
 * @property User $user
 * @property PejabatPenilai $pejabatPenilai
 * @property User $user
 * @property SkpGuru[] $skpGurus
 */
class Skp extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'skp';

    /**
     * @var array
     */
    protected $fillable = ['pengelola_kinerja', 'tim_angka_kredit', 'pejabat_penilai1', 'pejabat_penilai2', 'perencanaan', 'periode_awal', 'periode_akhir', 'penilaian'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailKinerjas()
    {
        return $this->hasMany('App\Models\DetailKinerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indikatorPenilaianPerilakus()
    {
        return $this->hasMany('App\Models\IndikatorPenilaianPerilaku');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kinerjas()
    {
        return $this->hasMany('App\Models\Kinerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penilaianPerilakuGurus()
    {
        return $this->hasMany('App\Models\PenilaianPerilakuGuru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rencanaKinerjaGurus()
    {
        return $this->hasMany('App\Models\RencanaKinerjaGuru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pejabatPenilaiUtama()
    {
        return $this->belongsTo('App\Models\PejabatPenilai', 'pejabat_penilai1', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengelolaKinerja()
    {
        return $this->belongsTo('App\Models\User', 'pengelola_kinerja', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pejabatPenilaiDua()
    {
        return $this->belongsTo('App\Models\PejabatPenilai', 'pejabat_penilai2', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'tim_angka_kredit', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skpGurus()
    {
        return $this->hasMany('App\Models\SkpGuru');
    }
}
