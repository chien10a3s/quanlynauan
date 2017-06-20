<?php

namespace App\Models\Kitchen;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kitchen\KitchenAttribute;
use App\User;
use App\Models\DailyMeal\DailyMeal;
use App\Food;

class Kitchen extends Model
{
    use KitchenAttribute;
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

    protected $fillable = ['user_id', 'bua_an_id', 'ngay', 'islocked', 'created_by', 'updated_by'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'kitchens';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_kitchens', 'id_kitchen', 'id_user');
    }
    public function daily_meal()
    {
        return $this->hasMany(DailyMeal::class, 'id_kitchen', 'id');
    }
    public function food()
    {
        return $this->belongsToMany(Food::class, 'user_spices', 'id_kitchen','id_food')->withPivot('status','id');
    }
}
