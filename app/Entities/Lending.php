<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $client_id
 * @property int $installment_amount
 * @property float $installment_price
 * @property float $value
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 * @property Installment[] $installments
 * @property Client client
 *
 * @method static Lending create(array $data)
 */
class Lending extends Model
{
    /** @var array */
    protected $with = [
        'client'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'installment_amount', 'installment_price', 'value', 'client_id'
    ];

    /** @var array */
    protected $casts = [
        'value' => 'float',
        'installment_amount' => 'int',
        'installment_price' => 'float',
        'created_at' => 'datetime:c',
        'updated_at' => 'datetime:c'
    ];

    /** @var array */
    protected $hidden = [
        'client'
    ];

    /**
     * Get the client that owns the lending.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the installments for the lending.
     */
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
