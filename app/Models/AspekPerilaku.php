<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nama
 * @property string $definisi
 * @property IndikatorKerja[] $indikatorKerjas
 * @property SituasiKerja[] $situasiKerjas
 */
class AspekPerilaku extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'aspek_perilaku';

    /**
     * @var array
     */
    protected $fillable = ['nama', 'definisi'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indikatorKerjas()
    {
        return $this->hasMany('App\Models\IndikatorKerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function situasiKerjas()
    {
        return $this->hasMany('App\Models\SituasiKerja');
    }
}
