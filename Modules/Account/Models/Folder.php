<?php

namespace Modules\Account\Models;

use App\Models\BaseModel;

/**
 * Class Folder
 */
class Folder extends BaseModel
{
    protected $connection = 'facile';
    protected $table = 'folder';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'grouping',
        'function_js',
        'is_visible',
        'order',
        'created_by'
    ];

    protected $guarded = [];
        
}