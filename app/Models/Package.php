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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function package_product()
    {
        return $this->hasMany('App\Models\PackageProduct', 'package_id', 'id')->with('product');
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}