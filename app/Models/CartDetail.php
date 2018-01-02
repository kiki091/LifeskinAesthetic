<?php

namespace App\Models;

use App\Models\BaseModel;

class CartDetail extends BaseModel
{
	protected $table = 'cart_detail';
    public $timestamps = false;

    protected $fillable = [
	    'product_id', 
	    'price',
        'discount',
        'book_date',
        'created_at', 
        'updated_by',
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
    public function scopeBookDate($query, $params)
    {
        return $query->where('book_date', $params);
    }
}