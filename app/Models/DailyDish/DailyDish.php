<?php

namespace App\Models\DailyDish;

use App\Models\DailyMeal\DailyMeal;
use Illuminate\Database\Eloquent\Model;
use App\Models\DishDetail\DishDetail;

class DailyDish extends Model
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
        $this->table = 'daily_dishs';
    }
    public function daily_dish()
    {
        return $this->hasMany(DishDetail::class, 'id_daily_dish', 'id');
    }

    /**
     * Get detail dish
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail_dish(){
        return $this->hasMany(DishDetail::class, 'id_daily_dish', 'id');
    }

    /**
     * Get info daily meal
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daily_meal(){
        return $this->belongsTo(DailyMeal::class, 'id_daily_meal', 'id');
    }
}
