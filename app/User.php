<?php

namespace App;

use App\Models\UserSpinner;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'provider',
        'avatar',
        'email_verified_at',
        'username',
        'email',
        'password',
        'verify_token',
        'score'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function spinner()
    {
        return $this->hasOne(UserSpinner::class, 'user_id', 'id');
    }
}
