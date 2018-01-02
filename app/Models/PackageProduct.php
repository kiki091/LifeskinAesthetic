<?php

namespace App\Models;

use App\Models\BaseModel;

class PackageProduct extends BaseModel
{
	protected $table = 'package_product';
    public $timestamps = false;

    protected $fillable = [
	    'product_id', 
	    'package_id',
        'package_product_id',
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
    public function scopePackageId($query, $params)
    {
        return $query->where('package_id', $params);
    }
}