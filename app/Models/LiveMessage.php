<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveMessage extends Model
{
    use HasFactory;

    protected $fillable = ['live_session_id', 'user_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liveSession()
    {
        return $this->belongsTo(LiveSession::class);
    }
}
