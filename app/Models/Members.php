<?php

namespace App\Models;

use App\Models\BaseModel;

class Members extends BaseModel
{
	protected $table = 'members';
    public $timestamps = false;

    protected $fillable = [
	    'first_name', 
	    'last_name',
        'email',
        'phone_number',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}