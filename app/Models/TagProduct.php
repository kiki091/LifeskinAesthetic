<?php

namespace App\Models;

use App\Models\BaseModel;

class TagProduct extends BaseModel
{
	protected $table = 'tag_product';
    public $timestamps = false;

    protected $fillable = [
	    'tag_id', 
        'product_id', 
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeTagId($query, $params)
    {
        return $query->where('tag_id', $params);
    }

    /**
     * @param $query
     */
    public function scopeProductId($query, $params)
    {
        return $query->where('product_id', $params);
    }
}