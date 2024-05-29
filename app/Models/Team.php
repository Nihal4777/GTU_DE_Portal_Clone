<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Team extends Model
{
    use HasFactory;
    
    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }
    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class,'submitted_by');
    }

}
