<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShirtOrder extends Model
{
    use HasFactory;

    protected $table = 'shirt_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'fabric_id',
        'collar_size',
        'chest_size',
        'waist_size',
        'wrist_size',
    ];


}
