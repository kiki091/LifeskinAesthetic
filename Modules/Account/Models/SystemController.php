<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class SystemController
 */
class SystemController extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'system_controller';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'display_name',
        'created_by'
    ];

    protected $guarded = [];


    public function systemFunction()
    {
        return $this->hasMany('Modules\Account\Models\SystemFunction');
    }

        
}