<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }

    public function ConsoleService()
    {
        return $this->belongsTo('App\Models\ConsoleServices', 'console_service_id', 'id');
    }
    public function AvailableTime(){
        return $this->belongsTo(AvailableTime::class,'available_time_id','id');
    }
}
