<?php

namespace App\Models;

use App\Models\BaseModel;

class Tag extends BaseModel
{
	protected $table = 'tag';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
        'slug', 
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