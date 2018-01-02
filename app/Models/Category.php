<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
	protected $table = 'category';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'slug',
        'created_at', 
        'updated_by',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_category()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    }

    
    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }

    /**
     * @param $query
     */
    public function scopeSlug($query, $params)
    {
        return $query->where('slug', $params);
    }
}