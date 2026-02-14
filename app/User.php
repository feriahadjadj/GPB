<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tel',
        'nbWilaya'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function projet()
    {
        return $this->hasMany('App\Projet');
    }

    public static function getUserName($id)
    {
        $user = User::find($id);
        return $user ? $user->name : 'Utilisateur inconnu';
    }

    public function isUser($email)
    {
        if ($this->email == $email) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * ✅ Notifications (override to use CustomDatabaseNotification)
     */
    public function notifications()
    {
        return $this->morphMany(\App\CustomDatabaseNotification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    public static function getNbNotifications()
    {
        $user = auth()->user();
        return $user ? $user->unreadNotifications()->count() : 0;
    }

    public function readNotifications()
    {
        return $this->notifications()->whereNotNull('read_at');
    }
}
