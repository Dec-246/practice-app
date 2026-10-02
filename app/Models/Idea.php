<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idea extends Model
{
    // telling eloquent not to guard any attributes - this is a security risk, but for this example, we will allow it
    protected $guarded = [];

    protected $attributes = [
        'state' => 'pending', //IdeaState
    ];

   public function user(): BelongsTo
   {
        return $this->belongsTo(User::class);
   }
}

