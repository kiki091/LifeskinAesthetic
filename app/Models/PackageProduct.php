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
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

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