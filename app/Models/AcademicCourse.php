<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_code', 
        'description',
        'credits',
        'start_date',
        'end_date',
        'is_active',
        'robot_kit_id' // NUEVO CAMPO
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->withTimestamps();
    }

    // NUEVA RELACIÓN
    public function robotKit()
    {
        return $this->belongsTo(RobotKit::class);
    }
}