<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class PrivilegeFunction
 */
class PrivilegeFunction extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'privilege_function';

    public $timestamps = true;

    protected $fillable = [
        'privilege_id',
        'system_function_id',
        'created_by'
    ];

    protected $guarded = [];

        
}