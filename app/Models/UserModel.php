<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; // Mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = ['username', 'password', 'nama', 'level_id', 'create_at', 'update_at'];
    
    protected $hidden = ['password',];

    protected $casts = ['password' => 'hashed'];

    /**
     * Relasi ke table level
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    /**
     * Mendapatkan nama role
     */
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    /**
     * cek apaka user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        return $this->level->level_nama === $role;
    }

    /**
     * Mendapatkan kde role
     */
    public function getRole()
    {
        return $this->level->level_kode;
    }
}
