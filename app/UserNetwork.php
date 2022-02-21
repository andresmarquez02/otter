<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserNetwork extends Model
{
    protected $guarded = [];

    public function network(){
        return $this->hasOne(Network::class,"id","network_id");
    }

}
