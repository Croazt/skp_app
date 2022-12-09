<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nip';

    protected $guard_name = 'skp';

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
    protected $fillable = ['pangkat_id', 'nama', 'pekerjaan', 'nip','unit_kerja', 'tugas_tambahan', 'username', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indikatorPenilaianPerilakus()
    {
        return $this->hasMany('App\Models\IndikatorPenilaianPerilaku', 'user_nip', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penilaianPerilakuGurus()
    {
        return $this->hasMany('App\Models\PenilaianPerilakuGuru', 'user_nip', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rencanaKinerjaGurus()
    {
        return $this->hasMany('App\Models\RencanaKinerjaGuru', 'user_nip', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengelolaKinerjaSkp()
    {
        return $this->hasMany('App\Models\Skp', 'pengelola_kinerja', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timAngkaKreditSkp()
    {
        return $this->hasMany('App\Models\Skp', 'tim_angka_kredit', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviuSkp()
    {
        return $this->hasMany('App\Models\SkpGuru', 'reviu_oleh', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifikasiSkp()
    {
        return $this->hasMany('App\Models\SkpGuru', 'verivikasi_oleh', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skpGurus()
    {
        return $this->hasMany('App\Models\SkpGuru', 'user_nip', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pangkat()
    {
        return $this->belongsTo('App\Models\Pangkat');
    }

    /**
     * The roles that user have.
     * 
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class)->using(RoleUser::class);
    }
    
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama', 'like', '%'.$query.'%')
                ->orWhere('nip', 'like', '%'.$query.'%')
                ->orWhere('username', 'like', '%'.$query.'%');
    }

    
    public function getRoleNames() : Collection
    {
        return $this->roles()->pluck('nama');
    }

    public function getPangkat() : string
    {
        $pangkat = $this->pangkat;
        if($pangkat instanceof Pangkat){
            return $pangkat->pangkat.', '.$pangkat->golongan_ruang.'/'.$pangkat->jabatan;
        }
        return '';
    }
}
