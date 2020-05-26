<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlaceholderPost extends Model
{
    public $fillable = [
        'placeholder_user_id',//internal fk
        'title',
        'body',
        'remote_post_id',
        'remote_user_id',//remote fk
        'fetched_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(PlaceholderUser::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PlaceholderComment::class);
    }
}
