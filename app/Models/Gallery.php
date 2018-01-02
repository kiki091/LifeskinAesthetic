<?php

namespace App\Models;

use App\Models\BaseModel;

class Gallery extends BaseModel
{
	protected $table = 'gallery';
    public $timestamps = false;

    protected $fillable = [
	    'title', 
	    'thumbnail',
        'filename',
        'created_at',
        'updated_by',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

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
    public function scopeCategoryId($query, $params)
    {
        return $query->where('category_id', $params);
    }
}