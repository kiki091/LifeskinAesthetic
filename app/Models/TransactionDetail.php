<?php

namespace App\Models;

use App\Models\BaseModel;

class TransactionDetail extends BaseModel
{
	protected $table = 'transaction_detail';
    public $timestamps = false;

    protected $fillable = [
	    'product_id', 
	    'price',
        'discount',
        'book_date',
        'created_at', 
        'updated_by',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    }


    /**
     * @param $query
     */
    public function scopeProductId($query, $params)
    {
        return $query->where('product_id', $params);
    }

    /**
     * @param $query
     */
    public function scopeBookDate($query, $params)
    {
        return $query->where('book_date', $params);
    }
}