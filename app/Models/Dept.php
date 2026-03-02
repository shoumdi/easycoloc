<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dept extends Model
{
    protected $fillable = ['amount','debitor_id','creditor_id','is_paid'];
    
    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }
    public function creditor(): BelongsTo
    {
        return $this->belongsTo(User::class,'creditor_id');
    }
    public function debitor(): BelongsTo
    {
        return $this->belongsTo(User::class,'debitor_id');
    }
}
