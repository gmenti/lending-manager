<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * @property int id
 * @property bool is_admin
 * @property Client[] clients
 * @method static $this findOrFail(int $id)
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /** @var array */
    protected $casts = [
        'is_admin' => 'bool',
        'created_at' => 'datetime:c',
        'updated_at' => 'datetime:c'
    ];

    /**
     * Get the clients for the user.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
