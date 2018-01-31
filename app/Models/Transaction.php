<?php

namespace App\Models;

use App\Models\BaseModel;

class Transaction extends BaseModel
{
	protected $table = 'transaction';
    public $timestamps = false;

    protected $fillable = [
	    'member_id', 
	    'status',
        'created_at', 
        'updated_by',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function detail()
    {
        return $this->belongsTo('App\Models\TransactionDetail', 'id', 'transaction_id')->with('package');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Models\Member', 'id', 'member_id');
    }

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