<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dean extends Model
{
    use HasFactory;

    protected $primaryKey = 'dean_id';

    protected $fillable = [
        'user_id',
        'coordinator_id',
        'department',
        'time_slots',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class, 'coordinator_id', 'coordinator_id');
    }
}
