<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $fillable = ['game', 'key', 'date_generated', 'duration', 'max_device', 'user_id', 'username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'date_generated' => 'datetime', // Ensure date_generated is cast to a Carbon instance
    ];
}
