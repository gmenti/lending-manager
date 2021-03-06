<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Lending lending
 */
class Installment extends Model
{
    /** @var array */
    protected $with = [
        'lending.client'
    ];

    /** @var array */
    protected $hidden = [
        'lending'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'due_at', 'paid_value', 'value'
    ];

    /** @var array */
    protected $casts = [
        'paid_value' => 'float',
        'value' => 'float',
        'due_at' => 'datetime:c',
        'created_at' => 'datetime:c',
        'updated_at' => 'datetime:c'
    ];

    /**
     * Get the client that owns the lending.
     */
    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }
}
