<?php

namespace App\Models;

use App\Traits\ProtocolTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protocol extends Model
{
    use HasFactory, SoftDeletes, ProtocolTrait;

    protected $guarded = [];

    public $timestamps = true;

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(ProtocolLog::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ProtocolStatus::class, 'protocol_status_id');
    }

    public function violation(): BelongsTo
    {
        return $this->belongsTo(Violation::class);
    }

    public function repression(): BelongsTo
    {
      return $this->belongsTo(Repression::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function violatorType(): BelongsTo
    {
        return $this->belongsTo(ViolatorType::class);
    }

    public function protocolType():BelongsTo
    {
        return $this->belongsTo(ProtocolType::class);
    }

    public function wells(): HasMany
    {
        return $this->hasMany(Well::class);
    }
}
