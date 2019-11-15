<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;
use OwenIt\Auditing\Contracts\UserResolver;


class User extends Authenticatable implements AudtitableContract
{
    use Auditable,  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_admin()
    {
        if($this->admin){ return true; }
        else{ return false; }
    }


    public function smshere()
    {
        $user = new User();
        $user->phone_number= '+639988964947';   // Don't forget specify country code.
        $user->notify(new SMSNotification());
    }


    // public static function resolveId()
    // {
    //     return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    // }
}
