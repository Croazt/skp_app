<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

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
