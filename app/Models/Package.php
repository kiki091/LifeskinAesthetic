<?php

namespace App\Models;

use App\Models\BaseModel;

class Package extends BaseModel
{
	protected $table = 'package';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'price',
        'description',
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