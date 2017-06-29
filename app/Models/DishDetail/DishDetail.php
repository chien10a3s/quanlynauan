<?php

namespace App\Models\DishDetail;

use App\Food;
use App\Models\DailyDish\DailyDish;
use Illuminate\Database\Eloquent\Model;

class DishDetail extends Model
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
        $this->table = 'detail_dishs';
    }

    /**
     * Get detail food
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function food()
    {
        return $this->hasOne(Food::class, 'id', 'id_food');
    }

    /**
     * Get info daily dish
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daily_dish(){
        return $this->belongsTo(DailyDish::class, 'id_daily_dish', 'id');
    }
}
