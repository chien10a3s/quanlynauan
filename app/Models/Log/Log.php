<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;

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
}
