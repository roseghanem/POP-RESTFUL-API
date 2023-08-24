<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, HasFactory, SoftDeletes;

    const VERIFIED_USER ='1';
    const UNVERIFIED_USER ='0';

    const ADMIN_USER ='TRUE';
    const REGULAR_USER ='FALSE';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'verified', 'verification_token', 'admin','remember_token', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    public function getNameAttribute($name){
        return ucfirst($name);
    }

    public function setNameAttribute($name){
        $this->attributes['name'] = ucfirst($name);
    }

    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }

    public function isVerified(){
        return $this->verified == User::VERIFIED_USER;
    }
    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
        return Str::random(40);
    }
}
