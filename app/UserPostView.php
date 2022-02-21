<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPostView extends Model
{
    protected $guarded = [];

    public function user(){
        return User::where("users.id",$this->user_id)->leftjoin("user_profiles","user_profiles.user_id","users.id")
        ->leftjoin("images","images.id","user_profiles.img_profile_id")
        ->select("users.*","images.img_url")->first();
    }
}
