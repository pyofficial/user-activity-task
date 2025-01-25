<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User  extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['full_name', 'email'];

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'user_activities')
            ->withPivot(['status', 'points', 'performed_at'])
            ->withTimestamps();
    }

    public function leaderboard()
    {
        return $this->hasOne(UsersLeaderboard::class);
    }

}
