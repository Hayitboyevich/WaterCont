<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Well extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status(): BelongsTo
    {
        return $this->belongsTo(WellStatus::class, 'well_status_id');
    }

    public function counterInfo(): BelongsTo
    {
        return $this->belongsTo(CounterInfo::class, 'counter_info_id');
    }

    public function smz(): BelongsTo
    {
        return $this->belongsTo(SMZ::class, 'smz_id');
    }

    public function debit(): BelongsTo
    {
        return $this->belongsTo(Debit::class, 'debit_id');
    }

    public function repression(): BelongsTo
    {
        return $this->belongsTo(Repression::class, 'repression_id');
    }
}
