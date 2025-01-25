<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'completion_points'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_activities')
            ->withPivot(['status', 'points', 'performed_at'])
            ->withTimestamps();
    }
}
