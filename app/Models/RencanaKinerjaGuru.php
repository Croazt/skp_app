<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $user_nip
 * @property integer $skp_id
 * @property integer $detail_kinerja_id
 * @property boolean $terkait
 * @property integer $target_kualitas
 * @property integer $target_kuantitas
 * @property integer $target_waktu
 * @property integer $realisiasi_kualitas
 * @property integer $realisasi_kuantitas
 * @property integer $realisasi_waktu
 * @property string $tanggal_verifikasi
 * @property string $lingkup
 * @property string $dokumen_bukti
 * @property User $user
 * @property DetailKinerja $detailKinerja
 * @property Skp $skp
 */
class RencanaKinerjaGuru extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rencana_kinerja_guru';

    /**
     * @var array
     */
    protected $fillable = ['terkait', 'target_kualitas', 'target_kuantitas', 'target_waktu', 'realisiasi_kualitas', 'realisasi_kuantitas', 'realisasi_waktu', 'tanggal_verifikasi', 'lingkup', 'dokumen_bukti'];

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
    public function detailKinerja()
    {
        return $this->belongsTo('App\Models\DetailKinerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skp()
    {
        return $this->belongsTo('App\Models\Skp');
    }
}
