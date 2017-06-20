<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['id', 'bannergroup_id', 'image', 'url', 'active']; 
}
