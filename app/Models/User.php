<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'nip',
        'position',
        'phone',
        'username',
        'email',
        'agency',
        'role',
        'password',
        'created_at',
        'updated_at',
    ];


    public function complaints()
    {
        return $this->hasMany(ComplaintModel::class, 'id_user');
    }
}
