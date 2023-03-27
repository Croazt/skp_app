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

    const GURU_MAPEL = 'Guru Mata Pelajaran';
    const GURU_BK = 'Guru Bimbingan Konseling';
    const GURU_KELAS = 'Guru Kelas';
    const GURU_KELOMPOK = 'Guru Kelompok';

    // const KEPSEK = 'Kepala Sekolah';
    // const KEPALA_UPT = 'Kepala UPT Sekolah';
    // const PLT_KEPSEK = 'Plt. Kepala Sekolah';
    const WAKASEK = 'Wakil Kepala Sekolah';
    const KAPROG_KEAHLIAN = 'Ketua Prog. Keahlian';
    const KAPERPUS = 'Kepala Perpustakaan';
    const KALAB = 'Kepala Laboratorium';
    const KABENG = 'Kepala Bengkel';
    const KAU = 'Kepala Unit Produksi';

    const PEKERJAAN = [
        self::GURU_MAPEL,
        self::GURU_BK,
        self::GURU_KELAS,
        self::GURU_KELOMPOK,
    ];

    const TUGAS_TAMBAHAN = [
        // self::KEPSEK,
        // self::KEPALA_UPT,
        // self::PLT_KEPSEK,
        self::WAKASEK,
        self::KAPROG_KEAHLIAN,
        self::KAPERPUS,
        self::KALAB,
        self::KABENG,
        self::KAU,
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
        return $this->hasMany('App\Models\SkpGuru', 'verifikasi_oleh', 'nip');
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
        $penilaianPerilaku = DB::table((User::whereHas('roles', function ($q) {
            $q->where('nama', Role::GURU);
        })), 'users')->select([
            'users.nip',
            DB::raw("IF(penilaian_perilaku.status IS NOT NULL,penilaian_perilaku.status, IF(skp_guru.status IS NOT NULL, 'Penilaian perilaku belum diisi', 'SKP belum direncanakan')) as status")
        ])->leftJoin(DB::raw('(SELECT * FROM skp_guru where skp_guru.skp_id =' . $skpId . ') as skp_guru'), 'users.nip', 'skp_guru.user_nip')
        ->leftJoin(DB::raw('(SELECT * FROM penilaian_perilaku_guru where skp_id =' . $skpId . ') as penilaian_perilaku'), 'penilaian_perilaku.user_nip', 'skp_guru.user_nip');
        
        return $query->select([
            'users.*',
            'penilaian_perilaku.status',
        ])->joinSub($penilaianPerilaku, 'penilaian_perilaku', 'penilaian_perilaku.nip', 'users.nip');
    }

    public function getPangkatJabatanName(): string
    {
        $pangkat = $this->pangkat;
        return $pangkat->pangkat . ', ' . $pangkat->golongan_ruang . '/' . $pangkat->jabatan;
    }
    public function getPangkatName(): string
    {
        $pangkat = $this->pangkat;
        return $pangkat->pangkat . ', ' . $pangkat->golongan_ruang;
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
