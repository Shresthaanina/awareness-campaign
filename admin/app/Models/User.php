<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'image',
        'is_active',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function create($data){
        $new_user               = new static();
        $new_user->name         = $data['name'] ?? NULL;
        $new_user->email        = $data['email'] ?? NULL;
        $new_user->password     = $data['password'] ? Hash::make($data['password']) : NULL;
        $new_user->phone_no     = $data['phone_no'] ?? NULL;
        $new_user->save();
        return $new_user;
    }

    public function campaigns(){
        return $this->hasMany('App\Models\Campaign','created_by');
    }
}
