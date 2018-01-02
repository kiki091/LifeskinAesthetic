<?php

namespace App\Models;

use App\Models\BaseModel;

class SubCategory extends BaseModel
{
	protected $table = 'sub_category';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'slug',
        'category_id',
    ];

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * @param $query
     */
    public function scopeSlug($query, $params)
    {
        return $query->where('slug', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}