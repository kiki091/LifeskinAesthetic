<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class Group
 */
class Group extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'menu_group';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'order',
        'icon',
        'system_id',
        'created_by'
    ];

    protected $guarded = [];

    public function menu()
    {
        return $this->hasMany('Modules\Account\Models\Menu', 'menu_id', 'id');
    }

    public function system()
    {
        return $this->belongsTo('Modules\Account\Models\System', 'system_id', 'id');
    }
}