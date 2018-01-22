<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class UserLocation
 */
class UserLocation extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'user_location';

    public $timestamps = false;

    protected $fillable = [
        'location_id',
        'user_id'
    ];

    protected $guarded = [];

        
}