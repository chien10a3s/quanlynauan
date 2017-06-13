<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use App\Food;

class Category extends Model
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
        $this->table = 'categories';
    }
    public function food()
    {
        return $this->hasMany(Food::class, 'id_category', 'id');
    }

}
