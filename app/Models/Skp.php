<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property string $pengelola_kinerja
 * @property string $tim_angka_kredit
 * @property string $pejabat_penilai
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
 * @property PengelolaKinerja $pengelolaKinerja
 * @property User $user
 * @property PejabatRencana $pejabatRencana
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
    protected $fillable = ['pengelola_kinerja', 'tim_angka_kredit', 'pejabat_penilai', 'perencanaan', 'periode_awal', 'periode_akhir', 'penilaian'];


    // protected $dates = [
    //     'perencanaan',
    //     'periode_awal',
    //     'periode_akhir',
    //     'penilaian',
    // ];

    // protected $casts = [
    //     'perencanaan' => 'date:d-m-Y',
    //     'periode_awal' => 'date:d-m-Y',
    //     'periode_akhir' => 'date:d-m-Y',
    //     'penilaian' => 'date:d-m-Y',
    // ];


    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-y');
    }
    protected function periodeAwal(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::create($value)->translatedFormat("d-m-Y"),
            set: fn ($value, $attributes) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
    protected function periodeAkhir(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::create($value)->translatedFormat("d-m-Y"),
            set: fn ($value, $attributes) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
    protected function perencanaan(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::create($value)->translatedFormat("d-m-Y"),
            set: fn ($value, $attributes) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
    
    protected function penilaian(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::create($value)->translatedFormat("d-m-Y"),
            set: fn ($value, $attributes) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
    
    public function scopeBaseQuery(Builder $query): Builder
    {
        return $query->select([
            'skp.*',
            DB::RAW("CONCAT(DATE_FORMAT(skp.periode_awal, '%d-%m-%Y'),' s.d ',DATE_FORMAT(skp.periode_akhir, '%d-%m-%Y')) as rentang"),
            DB::raw('(SELECT nama FROM pejabat_penilai WHERE skp.pejabat_penilai = pejabat_penilai.nip) as pejabat_penilai'),
            DB::raw('(SELECT nama FROM users WHERE skp.pengelola_kinerja = users.nip) as pengelola_kinerja'),
            DB::raw('(SELECT nama FROM users WHERE skp.tim_angka_kredit = users.nip) as tim_angka_kredit'),
        ]);
    }
    
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
    public function pejabatPenilai()
    {
        return $this->belongsTo('App\Models\PejabatPenilai', 'pejabat_penilai', 'nip');
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
    public function timAngkaKredit()
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
