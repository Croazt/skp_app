<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $pangkat_id
 * @property float $125
 * @property float $100
 * @property float $75
 * @property float $50
 * @property float $25
 * @property Pangkat $pangkat
 */
class PangkatPkgAk extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pangkat_pkg_ak';

    /**
     * @var array
     */
    protected $fillable = ['pangkat_id', '125', '100', '75', '50', '25'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pangkat()
    {
        return $this->belongsTo('App\Models\Pangkat');
    }
}
