<?php

namespace App\Models;

use App\Models\BaseModel;

class Subscribe extends BaseModel
{
	protected $table = 'subscribe';
    public $timestamps = false;

    protected $fillable = [
	    'email', 
	    'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}