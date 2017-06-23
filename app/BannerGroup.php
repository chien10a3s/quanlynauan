<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerGroup extends Model
{
    protected $fillable = ['id', 'name', 'active'];
    
    public function banners(){
        return $this->hasMany('App\Banner', 'bannergroup_id');
    }
}
