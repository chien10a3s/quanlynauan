<?php

namespace App\Models\Feedback;

use App\Models\Kitchen\Kitchen;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Feeback extends Model
{
    protected $table;

    protected $guarded = ['id'];

    protected $fillable = [];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'feedbacks';
    }

    /**
     * Get kitchen
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kitchen(){
        return $this->hasOne(Kitchen::class, 'id', 'id_kitchen');
    }

    /**
     * Get info user create_by
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function create_user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Get child feedback
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child(){
        return $this->hasMany(Feeback::class, 'parent_id');
    }
}
