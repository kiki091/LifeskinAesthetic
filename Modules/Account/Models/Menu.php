<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class Menu
 */
class Menu extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'menu';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'uri',
        'order',
        'menu_group_id',
        'function_js',
        'created_by'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function group()
    {
        return $this->belongsTo('Modules\Account\Models\Group', 'menu_group_id', 'id');
    }
        
}