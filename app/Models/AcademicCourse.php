<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCourse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_code',
        'course_name', 
        'description',
        'credits',
        'image',
        'is_active',
        'robot_kit_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'credits' => 'integer'
    ];

    /**
     * Get the robot kit associated with the course.
     */
    public function robotKit()
    {
        return $this->belongsTo(RobotKit::class, 'robot_kit_id');
    }

    /**
     * Get the image URL for the course.
     * This is an accessor that can be used in your views.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }

    /**
     * Scope a query to only include active courses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include courses with robot kits.
     */
    public function scopeWithRobotKits($query)
    {
        return $query->whereNotNull('robot_kit_id');
    }
}