<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlaceholderUser extends Model
{
    public $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'website',
        'remote_user_id',
        'fetched_at',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(PlaceholderPost::class);
    }
}
