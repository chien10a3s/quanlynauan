<?php

namespace App\Models\UserKitchen;

use App\Models\Kitchen\Kitchen;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserKitchen extends Model
{
    //
    protected $table;

    protected $guarded = ['id'];
    protected $fillable = ['id_kitchen', 'id_user', 'role', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * Get kitchen
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kitchen(){
        return $this->hasOne(Kitchen::class, 'id', 'id_kitchen');
    }

    /**
     * Get user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

}
