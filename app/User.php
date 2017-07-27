<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * function for the following that belong to the user.
     *
     *
    */
    public function following()
    {
      return $this->belongsToMany('App\User', 'followers', 'follower_user_id', 'user_id')->withTimestamps();
    }

    /**
     * function for the isfollowing user after user do follow user.
     *
     *
    */
    public function isFollowing(User $user)
    {
      return !is_null($this->following()->where('user_id', $user->id)->first());
    }

    /*
      the followers that belong to the user
    */
    public function followers()
    {
      return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_user_id')->withTimestamps();
    }
}
