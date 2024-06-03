<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;

    protected $primaryKey = 'coordinator_id';

    protected $fillable = [
        'user_id',
        'dean_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deans()
    {
        return $this->hasMany(Dean::class, 'coordinator_id', 'coordinator_id');
    }
}

