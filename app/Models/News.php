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