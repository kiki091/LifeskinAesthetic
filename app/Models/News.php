<?php

namespace App\Models;

use App\Models\BaseModel;

class News extends BaseModel
{
	protected $table = 'news';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'slug',
        'introduction',
        'description',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id')->with('category');
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