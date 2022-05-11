<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    protected $fillable =[
        'bio','skills','experiance','description'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


    public function consoleServices()
    {
        return $this->hasMany('App\Models\ConsoleServices', 'id', 'console_id');
    }

    #available time relationship
    public function times()
    {
        return $this->hasMany('App\Models\AvailableTime', 'console_id', 'id');
    }
    ########## this relationship has 4 keys to pass in #####
    public function userWallet(){
        return $this->hasOneThrough(Wallet::class,User::class,'id','user_id','user_id','id')->withDefault(0);
    }
}

