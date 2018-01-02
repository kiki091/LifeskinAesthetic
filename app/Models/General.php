<?php

namespace App\Models;

use App\Models\BaseModel;

class General extends BaseModel
{
	protected $table = 'general';
    public $timestamps = false;

    protected $fillable = [
	    'web_title', 
	    'favicon',
        'logo',
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