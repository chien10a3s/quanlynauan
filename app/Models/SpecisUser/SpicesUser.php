<?php

namespace App\Models\SpecisUser;

use Illuminate\Database\Eloquent\Model;

class SpicesUser extends Model
{
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

    protected $fillable = ['id_kitchen', 'id_user', 'id_food', 'created_by', 'updated_by', 'remember_token'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'user_spices';
    }
}
