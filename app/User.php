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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function img_profile()
    {
        return UserProfile::where("user_id",$this->id)->leftjoin("images","images.id","user_profiles.img_profile_id")
        ->select("images.img_url","images.id")->first();
    }

    public function img_portada()
    {
        return UserProfile::where("user_id",$this->id)->leftjoin("image_portadas","image_portadas.id","user_profiles.img_portada_id")
        ->select("image_portadas.img")->first();
    }

    public function networks()
    {
        return $this->hasMany(UserNetwork::class, 'user_id', 'id');
    }

    public function views_posts()
    {
        return $this->hasOne(UserPostView::class, 'user_id', 'id');
    }
}
