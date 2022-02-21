<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Historical extends Model
{
    protected $table = "historicals";
    protected $guarded = [];

    public function post(){
        return DB::table('posts')
        ->leftjoin("users","users.id","posts.user_id")
        ->leftjoin("user_profiles","user_profiles.user_id","users.id")
        ->leftjoin("images","images.id","user_profiles.img_profile_id")
        ->select("posts.*","users.name","images.img_url","users.status")
        ->where("posts.id",$this->post_id)->first();
    }
}
