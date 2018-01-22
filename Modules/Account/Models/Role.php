<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class Role
 */
class Role extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'role';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'desc',
        'order',
        'created_by'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privilege()
    {
        $model = config('facile.core.modules')['account']['privilege'];
        $class = '\\'.ltrim($model, '\\');

        return $this->belongsToMany(new $class, 'role_privilege', 'role_id', 'privilege_id')
            ->with(['systemFunction', 'system', 'menu']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rolePrivileges()
    {
        $model = config('facile.core.modules')['account']['roleprivilege'];
        $class = '\\'.ltrim($model, '\\');

        return $this->hasMany(new $class, 'role_id', 'id')->with('detailPrivilege');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIdRole($query, $params = true)
    {
        return $query->where('id', $params);
    }

}