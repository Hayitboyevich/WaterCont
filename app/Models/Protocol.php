<?php

namespace App\Models;

use App\Traits\ProtocolTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Protocol extends Model
{
    use HasFactory, SoftDeletes, ProtocolTrait;

    protected $guarded = [];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function log(): HasMany
    {
        return $this->hasMany(ProtocolLog::class);
    }
}
