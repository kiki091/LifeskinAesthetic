<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class User
 */
class User extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'user';

    public $timestamps = true;

    protected $fillable = [
        'is_active',
        'name',
        'email',
        'password',
        'update_at',
        'created_by'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        $model = config('facile.core.modules')['account']['role'];
        $class = '\\'.ltrim($model, '\\');

        return $this->belongsToMany(new $class, 'user_role', 'user_id', 'role_id')->with('privilege');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /**
     * @param $query
     */
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}