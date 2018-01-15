<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * Class MailJobs
 */
class MailJobs extends BaseModel
{
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