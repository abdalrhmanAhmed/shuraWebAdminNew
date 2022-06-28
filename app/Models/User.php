<?php

namespace App\Models;

use App\Http\Controllers\Api\apiResponseTrait;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable,apiResponseTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','email','password','photo', 'country','phone',
        'username','gendor','type','isActive'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function profile()
    {
        $user = Auth::user()->type;
        if($user == 1 || $user == 0){
            return $this->hasOne(Console::class,'user_id','id')->withDefault(0);
        }elseif($user == 2){
            return $this->hasOne(Client::class,'user_id','id')->withDefault(0);
        }else{
            return 'no profile for this type of user';
        }
    }
    public function getImagePathAttribute()
    {
        return asset('upload/catiguriesIcon/' . $this->photo);
    }
    public function wallet(){
        return $this->hasOne(Wallet::class,'user_id','id')->withDefault(0);
    }
    public function consoleServices(){
        return $this->hasManyThrough(consoleServices::class,Console::class,'user_id','console_id','id','id')->withDefault(0);
    }

    public function verfications()
    {
        return $this->hasMany(User_verfication::class, 'user_id');
    }//end of verfication code
}
