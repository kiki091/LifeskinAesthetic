<?php

namespace App\Models;

use App\Models\BaseModel;

class Information extends BaseModel
{
	protected $table = 'information';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'introduction',
        'home_description',
        'home_images',
        'gallery_title',
        'gallery_introduction',
        'offers_title',
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}