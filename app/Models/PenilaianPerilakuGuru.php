<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $user_nip
 * @property integer $skp_id
 * @property string $status
 * @property string $tanggal_konfirmasi
 * @property integer $konfirmasi_oleh
 * @property Skp $skp
 * @property User $user
 */
class PenilaianPerilakuGuru extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'penilaian_perilaku_guru';

    /**
     * @var array
     */
    protected $fillable = ['status', 'tanggal_konfirmasi', 'konfirmasi_oleh','user_nip','skp_id'];

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
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_nip', 'nip');
    }
    public function konfirmasiOleh()
    {
        return $this->belongsTo('App\Models\User', 'konfirmasi_oleh', 'nip');
    }
}
