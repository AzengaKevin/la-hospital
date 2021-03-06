<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'contacts'
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

    /**
     * Available User Types
     * 
     * @return array of the options
     */
    public static function types() : array
    {
        return ['doctor', 'patient'];
    }

    /**
     * Get all the available options
     * 
     * @return array of user gender options
     */
    public static function genderOptions() : array
    {
        return ['Male', 'Female', 'Other'];
    }

    /**
     * Making the user entity inheritable
     */
    public function authenticable()
    {
        return $this->morphTo();
    }

    /**
     * User Requests Relationship
     */
    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
