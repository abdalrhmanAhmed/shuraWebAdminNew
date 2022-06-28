<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsoleServices extends Model
{
    use HasFactory;
    protected $fillable =[
        'console_id','service_id','price'
    ];
    public function console()
    {
        return $this->belongsTo(Console::class, 'console_id', 'id');
    }

    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'id', 'console_service_id');
    }
    public function user(){
        return $this->hasOneThrough(User::class,Console::class,'id','id','console_id','user_id')->withDefault(0);
    }
}
