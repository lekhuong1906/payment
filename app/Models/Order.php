<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        '_id',
        'user_id',
        'products',
        'total_amount',
        'status',
        'cancelled_by',
    ];
    protected $attributes = [
        'status' => self::STATUS_PENDING,
        'cancelled_by' => self::CANCELLED_BY_NONE,
    ];

    const STATUS_PENDING = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELLED = 2;

    const CANCELLED_BY_NONE = 0;
    const CANCELLED_BY_USER = 1;
    const CANCELLED_BY_ADMIN = 2;
}
