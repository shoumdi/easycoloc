<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $fillable = ['token'];


    public function expired(){
        return $this->status !== 'PENDING';
    }

    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }
}
