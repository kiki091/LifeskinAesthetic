<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailJobs
 */
class MailJobs extends Model
{
    protected $connection = 'facile';
    protected $table = 'mail_jobs';

    public $timestamps = true;

    protected $fillable = [
        'view',
        'data',
        'status',
        'error',
        'created_by',
    ];

    protected $guarded = [];
}