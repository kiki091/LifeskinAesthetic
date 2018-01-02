<?php

namespace App\Models;

use App\Models\BaseModel;

class About extends BaseModel
{
	protected $table = 'about';
    public $timestamps = false;

    protected $fillable = [
	    'created_at', 
	    'updated_by',
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