<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $situasi_kerja_id
 * @property string $user_nip
 * @property integer $skp_id
 * @property integer $indikator_kerja_id
 * @property Skp $skp
 * @property SituasiKerja $situasiKerja
 * @property User $user
 * @property IndikatorKerja $indikatorKerja
 */
class IndikatorPenilaianPerilaku extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'indikator_penilaian_perilaku';

    /**
     * @var array
     */
    protected $fillable = ['indikator_kerja_id'];

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
    public function situasiKerja()
    {
        return $this->belongsTo('App\Models\SituasiKerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_nip', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indikatorKerja()
    {
        return $this->belongsTo('App\Models\IndikatorKerja');
    }
}
