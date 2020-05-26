<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCall extends Model
{
    protected $fillable = [
        'endpoint',
        'url',
        'method',
        'response',
        'status_code',
        'sent_at',
    ];

    protected $dates = [
        'sent_at',
        'created_at',
        'updated_at',
    ];
}
