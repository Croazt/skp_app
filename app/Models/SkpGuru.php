<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property string $user_nip
 * @property integer $skp_id
 * @property string $verifikasi_oleh
 * @property string $reviu_oleh
 * @property string $pejabat_rencana
 * @property string $pejabat_nilai
 * @property string $status
 * @property string $tanggal_konfirmasi
 * @property string $tanggal_verifikasi
 * @property string $tanggal_reviu
 * @property string $tanggal_realisasi
 * @property integer $jam_pelajaran
 * @property integer $target_pkg
 * @property integer $target_pkg_tambahan
 * @property integer $capaian_jam_pelajaran
 * @property integer $capaian_pkg
 * @property integer $capaian_pkg_tambahan
 * @property integer $pangkat_rencana
 * @property integer $pangkat_nilai
 * @property User $user
 * @property PejabatPenilai $pejabatRencana
 * @property Skp $skp
 * @property User $user
 * @property User $user
 * @property PejabatPenilai $pejabatPenilai
 */
class SkpGuru extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'skp_guru';

    const DRAFT = 'draft';
    const KONFIRMASI = 'konfirmasi';
    const REVIU = 'reviu';
    const VERIFIKASI = 'verifikasi';
    const BUKTI = 'bukti';
    const DITOLAK = 'ditolak';
    const DINILAI = 'dinilai';
    public const STATUS = [
        self::DRAFT,
        self::KONFIRMASI,
        self::REVIU,
        self::VERIFIKASI,
        self::BUKTI,
        self::DITOLAK,
        self::DINILAI,
    ];
    /**
     * @var array
     */
    protected $fillable = ['user_nip', 'verifikasi_oleh', 'reviu_oleh', 'pejabat_rencana', 'pejabat_nilai', 'status', 'tanggal_konfirmasi', 'tanggal_verifikasi', 'tanggal_reviu', 'tanggal_realisasi', 'jam_pelajaran', 'target_pkg', 'target_pkg_tambahan', 'capaian_jam_pelajaran', 'capaian_pkg', 'capaian_pkg_tambahan', 'pangkat_rencana', 'pangkat_nilai'];

    public function scopeBaseQuery(Builder $query, int $skpId): Builder
    {
        return $query->select(['users.nama', 'skp_guru.*', 'users.nip as nip'])->leftJoin('users', 'users.nip', 'skp_guru.user_nip')->where('skp_id', $skpId);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviu()
    {
        return $this->belongsTo('App\Models\User', 'reviu_oleh', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pejabatPenilai()
    {
        return $this->belongsTo('App\Models\PejabatPenilai', 'pejabat_nilai', 'nip');
    }

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
    public function verifikasi()
    {
        return $this->belongsTo('App\Models\User', 'verifikasi_oleh', 'nip');
    }

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
    public function pejabatRencana()
    {
        return $this->belongsTo('App\Models\PejabatPenilai', 'pejabat_rencana', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rencanaKinerjaGurus()
    {
        return $this->hasMany('App\Models\RencanaKinerjaGuru', 'skp_guru_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pangkatRencana()
    {
        return $this->belongsTo('App\Models\Pangkat', 'pangkat_rencana', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pangkatNilai()
    {
        return $this->belongsTo('App\Models\Pangkat', 'pangkat_nilai', 'id');
    }

    public function getPangkatJabatanName(string $tipe): string
    {
        $attribute = 'pangkat' . $tipe;
        $pangkat = $this->$attribute;
        if ($pangkat instanceof Pangkat) {
            return $pangkat->pangkat . ', ' . $pangkat->golongan_ruang . '/' . $pangkat->jabatan;
        }
        return '';
    }
    public function getPangkatName(string $tipe): string
    {
        $attribute = 'pangkat' . $tipe;
        $pangkat = $this->$attribute;
        if ($pangkat instanceof Pangkat) {
            return $pangkat->pangkat . ', ' . $pangkat->golongan_ruang;
        }
        return '';
    }
    public function getPangkat(string $tipe): array
    {
        $attribute = 'pangkat' . $tipe;
        $pangkat = $this->$attribute;
        if ($pangkat instanceof Pangkat) {
            return [$this->pangkat->id => $pangkat->pangkat . ', ' . $pangkat->golongan_ruang . '/' . $pangkat->jabatan];
        }
        return [];
    }
}
