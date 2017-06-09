<?php

namespace App\Models\DailyMeal;

use App\Models\Kitchen\Kitchen;
use Illuminate\Database\Eloquent\Model;
use App\Models\DailyDish\DailyDish;

class DailyMeal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $fillable = [];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'daily_meals';
    }

    public function daily_dish()
    {
        return $this->hasMany(DailyDish::class, 'id_daily_meal', 'id');
    }

    /**
     * Get kitchen
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kitchen(){
        return $this->hasOne(Kitchen::class, 'id', 'id_kitchen');
    }
}
