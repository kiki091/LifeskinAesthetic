<?php

namespace App\Models;

use App\Models\BaseModel;

class ContactUs extends BaseModel
{
	protected $table = 'contact_us';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'slug',
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

    /**
     * @param $query
     */
    public function scopeEmail($query, $params)
    {
        return $query->where('email', $params);
    }
}