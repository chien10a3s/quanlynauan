<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;
use App\Models\DailyDish\DailyDish;

class Log extends Model
{
    //
    protected $table;

    protected $guarded = ['id'];

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'logs';
    }

    public function daily_dish()
    {
        return $this->hasMany(DailyDish::class, 'id_daily_meal', 'item_id');
    }
}
