<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class System
 */
class System extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'system';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'order',
        'created_by'
    ];

    protected $guarded = [];

    public function group()
    {
        return $this->hasMany('Modules\Account\Models\Group','group_id','id');
    }
}