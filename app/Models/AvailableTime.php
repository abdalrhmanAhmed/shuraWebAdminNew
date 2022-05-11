<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'console_id','day','from','to'
    ];

    public function console()
    {
        return $this->belongsTo('App\Models\Console', 'console_id', 'id');
    }
}
