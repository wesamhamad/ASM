<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'student_id',
        'dean_id',
        'coordinator_id',
        'appointment_time',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function dean()
    {
        return $this->belongsTo(Dean::class, 'dean_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class, 'coordinator_id');
    }
    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['date_range'])) {
            $dates = explode(' - ', $filters['date_range']);
            $query->whereBetween('appointment_time', [trim($dates[0]), trim($dates[1])]);
        }

        if (!empty($filters['student_name'])) {
            $query->whereHas('student', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['student_name'] . '%');
            });
        }

        return $query;
    }
}
