<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class SystemFunction
 */
class SystemFunction extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'system_function';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'system_controller_id',
        'created_by',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function systemController()
    {
        return $this->belongsTo('Modules\Account\Models\SystemController', 'system_controller_id');
    }

    public function privilege()
    {
        return $this->belongsToMany('Modules\Account\Models\Privilege', 'privilege_function');
    }   
}