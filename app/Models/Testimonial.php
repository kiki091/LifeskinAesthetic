<?php

namespace App\Models;

use App\Models\BaseModel;

class Testimonial extends BaseModel
{
	protected $table = 'testimonial';
    public $timestamps = false;

    protected $fillable = [
	    'description', 
        'member_id', 
        'created_at', 
        'updated_at', 
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeMemberId($query, $params)
    {
        return $query->where('member_id', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}