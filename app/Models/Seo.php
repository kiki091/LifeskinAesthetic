<?php

namespace App\Models;

use App\Models\BaseModel;

class Seo extends BaseModel
{
	protected $table = 'seo';
    public $timestamps = false;

    protected $fillable = [
	    'created_at', 
	    'updated_by',
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeKey($query, $params)
    {
        return $query->where('seo_key', $params);
    }
}