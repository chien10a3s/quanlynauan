<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'description', 'image', 'unit', 'quantity', 'price', 'id_category', 'id_supplier', 'status', 'created_by', 'updated_by'];
    
    public function save(array $options = [])
    {
        $this->image = $this->image ?: config('voyager.food.default_image', 'food/default.png');

        parent::save();
    }
}
