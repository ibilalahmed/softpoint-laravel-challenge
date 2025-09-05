<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Enables soft-deleting

class RealEstate extends Model
{
    use HasFactory, SoftDeletes; // Add both traits here

    /**
     * The attributes that are mass assignable.
     * This is required for creating and updating records easily.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'real_state_type',
        'street',
        'external_number',
        'internal_number',
        'neighborhood',
        'city',
        'country',
        'rooms',
        'bathrooms',
        'comments',
    ];
}