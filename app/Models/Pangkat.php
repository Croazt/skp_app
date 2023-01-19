<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $jabatan
 * @property string $pangkat
 * @property PejabatPenilai[] $pejabatPenilais
 * @property User[] $users
 */
class Pangkat extends Model
{
    

    const GURU_PERTAMA = 'Guru Pertama';
    const GURU_MUDA = 'Guru Muda';
    const GURU_MADYA = 'Guru Madya';
    const GURU_UTAMA = 'Guru Utama';
    
    public $timestamps=false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pangkat';

    /**
     * @var array
     */
    protected $fillable = ['id','jabatan', 'pangkat', 'golongan_ruang'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pejabatPenilais()
    {
        return $this->hasMany('App\Models\PejabatPenilai');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
