<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Request extends Model
{
    use HasFactory;


    public function guides(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
