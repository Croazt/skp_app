<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $aspek_perilaku_id
 * @property string $situasi
 * @property AspekPerilaku $aspekPerilaku
 * @property IndikatorPenilaianPerilaku[] $indikatorPenilaianPerilakus
 */
class IndikatorKerja extends Model
{
    public $timestamps=false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'indikator_kerja';

    /**
     * @var array
     */
    protected $fillable = ['aspek_perilaku_id', 'situasi'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aspekPerilaku()
    {
        return $this->belongsTo('App\Models\AspekPerilaku');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indikatorPenilaianPerilakus()
    {
        return $this->hasMany('App\Models\IndikatorPenilaianPerilaku');
    }
}
