<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'phone_number',
        'isDefault',
    ];

    protected $casts = [
        'isDefault' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
