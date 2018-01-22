<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class UserRole
 */
class UserRole extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'user_role';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'role_id',
        'created_by'
    ];

    protected $guarded = [];

        
}