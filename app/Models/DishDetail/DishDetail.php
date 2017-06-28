<?php

namespace App\Models\DishDetail;

use App\Food;
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
        return $this->hasOne(Food::class, 'id', 'food_id');
    }
}
