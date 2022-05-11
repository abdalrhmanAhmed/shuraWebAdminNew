<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['bio'];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'id', 'client_id');
    }
    ########## this relationship has 4 keys to pass in #####
    public function userWallet(){
        return $this->hasOneThrough(Wallet::class,User::class,'id','user_id','user_id','id')->withDefault(0);
    }
}
