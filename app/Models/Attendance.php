<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'check_in', 'note'];
    
    protected $casts = [
        'check_in' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
