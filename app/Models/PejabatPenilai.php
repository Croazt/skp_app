<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $nip
 * @property integer $pangkat_id
 * @property string $atasan
 * @property string $nama
 * @property string $pekerjaan
 * @property integer $unit_kerja
 * @property Pangkat $pangkat
 * @property PejabatPenilai $pejabatPenilai
 * @property Skp[] $skps
 * @property Skp[] $skps
 * @property SkpGuru[] $skpGurus
 * @property SkpGuru[] $skpGurus
 */
class PejabatPenilai extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pejabat_penilai';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nip';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['pangkat_id', 'atasan', 'nama', 'pekerjaan', 'unit_kerja'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pangkat()
    {
        return $this->belongsTo('App\Models\Pangkat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pejabatPenilai()
    {
        return $this->belongsTo('App\Models\PejabatPenilai', 'atasan', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function utamaSkp()
    {
        return $this->hasMany('App\Models\Skp', 'pejabat_penilai1', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function duaSkp()
    {
        return $this->hasMany('App\Models\Skp', 'pejabat_penilai2', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilaiSkp()
    {
        return $this->hasMany('App\Models\SkpGuru', 'pejabat_nilai', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rencanaSkp()
    {
        return $this->hasMany('App\Models\SkpGuru', 'pejabat_rencana', 'nip');
    }
}
