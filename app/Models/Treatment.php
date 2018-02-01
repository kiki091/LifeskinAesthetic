<?php

namespace App\Models;

use App\Models\BaseModel;

class Treatment extends BaseModel
{
	protected $table = 'treatment';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'slug',
        'description',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

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