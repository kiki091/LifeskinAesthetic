<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class Privilege
 */
class Privilege extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'privilege';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'desc',
        'order',
        'system_id',
        'created_by',
        'menu_id'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function systemFunction()
    {
        return $this->belongsToMany('Modules\Account\Models\SystemFunction', 'privilege_function', 'privilege_id', 'system_function_id')->with('SystemController');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function system()
    {
        return $this->belongsTo('Modules\Account\Models\System', 'system_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu()
    {
        return $this->belongsTo('Modules\Account\Models\Menu', 'menu_id', 'id')->with('group');
    }
}