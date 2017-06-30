<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;

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

    public function supplier(){
        return $this->hasOne(Supplier::class,'id','id_supplier');
    }

    /**
     * Get info category of food
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(){
        return $this->hasOne(FoodCategory::class, 'id', 'id_category');
    }
}
