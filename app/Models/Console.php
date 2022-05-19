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

    public function services()
    {
        return $this->belongsToMany(Service::class, 'console_services');
    }//end of services relationship

    public function consoleFile()
    {
        return $this->hasMany(ConsoleFiles::class);
    }//end of console files relationship

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

