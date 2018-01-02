<?php

namespace App\Models;

use App\Models\BaseModel;

class RelatedProduct extends BaseModel
{
	protected $table = 'related_product';
    public $timestamps = false;

    protected $fillable = [
	    'product_id', 
        'related_product_id', 
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeProductId($query, $params)
    {
        return $query->where('product_id', $params);
    }

    /**
     * @param $query
     */
    public function scopeRelatedProductId($query, $params)
    {
        return $query->where('related_product_id', $params);
    }
}