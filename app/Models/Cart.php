<?php

namespace App\Models;

use App\Models\BaseModel;

class Cart extends BaseModel
{
	protected $table = 'cart';
    public $timestamps = false;

    protected $fillable = [
	    'member_id', 
	    'status',
        'created_at', 
        'updated_by',
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