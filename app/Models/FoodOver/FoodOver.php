<?php

namespace App\Models\FoodOver;

use App\Food;
use App\Models\Kitchen\Kitchen;
use Illuminate\Database\Eloquent\Model;

class FoodOver extends Model
{
    //
    protected $table;

    protected $guarded = ['id'];

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'food_overs';
    }

    /**
     * Get kitchen
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kitchen(){
        return $this->hasOne(Kitchen::class, 'id', 'kitchen_id');
    }

    /**
     * Get food
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function food(){
        return $this->hasOne(Food::class, 'id', 'food_id');
    }
}
