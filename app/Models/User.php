<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
    protected $fillable = ['pangkat_id', 'nama', 'pekerjaan', 'nip', 'unit_kerja', 'tugas_tambahan', 'email', 'password'];

    const PEKERJAAN = [
        'Guru Mata Pelajaran',
        'Guru Bimbingan Konseling',
        'Guru Kelas',
        'Guru Kelompok',
    ];

    const TUGAS_TAMBAHAN = [
        'Kepala Sekolah',
        'Kepala UPT Sekolah',
        'Plt. Kepala Sekolah',
        'Wakil Kepala Sekolah',
        'Ketua Prog. Keahlian',
        'Kepala Perpustakaan',
        'Kepala Laboratorium',
        'Kepala Bengkel',
        'Kepala Unit Produksi',
    ];

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
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->using(RoleUser::class);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nama', 'like', '%' . $query . '%')
            ->orWhere('nip', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%');
    }

    public function getRoleName(): Collection
    {
        return $this->roles()->pluck('nama');
    }

    public function scopePenilaianPerilakuQuery(Builder $query, int $skpId): Builder
    {
        return $query->select([
            'users.*',
            DB::raw("IF(penilaian_perilaku.status IS NOT NULL,penilaian_perilaku.status, IF(skp_guru.status IS NOT NULL, 'Belum diisi', 'SKP belum dibuat')) as status"),
        ])->whereHas('roles', function ($q) {
            $q->where('nama', Role::GURU);
        })->leftJoin(DB::raw('(SELECT * FROM penilaian_perilaku_guru where skp_id =' . $skpId . ') as penilaian_perilaku'), 'users.nip', 'penilaian_perilaku.user_nip')
        ->leftJoin(DB::raw('(SELECT * FROM skp_guru where skp_guru.skp_id =' . $skpId . ') as skp_guru'), 'users.nip', 'skp_guru.user_nip');
    }

    public function getPangkatname(): string
    {
        $pangkat = $this->pangkat;
        return $pangkat->pangkat . ', ' . $pangkat->golongan_ruang . '/' . $pangkat->jabatan;
    }
    public function getPangkat(): array
    {
        $pangkat = $this->pangkat;
        if ($pangkat instanceof Pangkat) {
            return [$this->pangkat->id => $pangkat->pangkat . ', ' . $pangkat->golongan_ruang . '/' . $pangkat->jabatan];
        }
        return [];
    }
}
