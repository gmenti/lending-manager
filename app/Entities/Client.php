<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int id
 * @property User user
 * @method static Client findOrFail(int $id)
 * @method static Client[] all()
 * @method static Client create(array $data)
 * @method static Client first()
 */
class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'document', 'phone_number',
        'city', 'address', 'street', 'complement', 'number'
    ];

    /** @var array */
    protected $casts = [
        'created_at' => 'datetime:c',
        'updated_at' => 'datetime:c'
    ];

    /**
     * Get the user that owns the client.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lendings for the client.
     */
    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }
}
