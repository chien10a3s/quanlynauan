<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    public function foods()
    {
        return $this->hasMany('App\Food')
            ->published()
            ->orderBy('created_at', 'DESC');
    }
    
    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
}
