<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $skp_id
 * @property string $deskripsi
 * @property string $kategori
 * @property DetailKinerja[] $detailKinerjas
 * @property Skp $skp
 */
class Kinerja extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kinerja';

    /**
     * @var array
     */
    protected $fillable = ['skp_id', 'deskripsi', 'kategori'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailKinerjas()
    {
        return $this->hasMany('App\Models\DetailKinerja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skp()
    {
        return $this->belongsTo('App\Models\Skp');
    }
}
