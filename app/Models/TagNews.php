<?php

namespace App\Models;

use App\Models\BaseModel;

class TagNews extends BaseModel
{
	protected $table = 'tag_news';
    public $timestamps = false;

    protected $fillable = [
	    'tag_id', 
        'news_id', 
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
    public function scopeNewsId($query, $params)
    {
        return $query->where('news_id', $params);
    }
}