<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['id', 'image', 'heading', 'description', 'button', 'url', 'active'];
    
}
