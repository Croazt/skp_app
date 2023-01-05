<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    const GURU = 'Guru';
    const OPERATOR = 'Operator';
    const TIM_ANGKA_KREDIT = 'Tim Angka Kredit';
    const PENGELOLA_KINERJA = 'Pengelola Kinerja';
    const KEPALA_SEKOLAH = 'Kepala Sekolah';

    const GURU_PERTAMA = 'Guru Pertama';
    const GURU_MUDA = 'Guru Muda';
    const GURU_MADYA = 'Guru Madya';
    const GURU_UTAMA = 'Guru Utama';
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $keyType = 'string';

    protected $primaryKey = 'nama';
    /**
     * @var array
     */
    protected $fillable = ['nama'];

    /**
     * The The users that belong to the role.
     * 
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }
}
