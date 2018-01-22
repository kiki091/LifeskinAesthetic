<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class RolePrivilege
 */
class RolePrivilege extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'role_privilege';

    public $timestamps = true;

    protected $fillable = [
        'role_id',
        'privilege_id',
        'created_by'
    ];

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function detailPrivilege()
    {
        $model = config('facile.core.modules')['account']['privilege'];
        $class = '\\'.ltrim($model, '\\');

        return $this->belongsTo(new $class, 'privilege_id', 'id');
    }

        
}