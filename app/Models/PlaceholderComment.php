<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceholderComment extends Model
{
    public $fillable = [
        'placeholder_post_id',//internal fk
        'name',
        'email',
        'body',
        'remote_comment_id',
        'remote_post_id',//remote fk
        'fetched_at',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(PlaceholderPost::class);
    }
}
