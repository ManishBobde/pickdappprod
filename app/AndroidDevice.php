<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class AndroidDevice extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'androiddevices';

    //protected $guarded = ['deviceId'];

    /**
     * The roles that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany('PD\Categories\Categories');
    }


    public function feedback()
    {
        return $this->hasMany('App\FeedBack');
    }
}
