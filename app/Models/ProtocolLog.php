<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProtocolLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

//    public function images(): MorphMany
//    {
//        return $this->morphMany(Image::class, 'imageable');
//    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ProtocolStatus::class, 'protocol_status_id');
    }
}
