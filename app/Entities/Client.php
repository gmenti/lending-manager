<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @method static $this findOrFail(int $id)
 * @method static Client[] all()
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
}
