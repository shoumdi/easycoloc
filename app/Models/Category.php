<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'description'];
    protected $table = 'categories';

    public function activeDepenses()
    {
        return $this->colocation
            ->depts()
            ->where('is_paid', false)
            ->count();
    }
    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }

    public function depenses(): HasMany
    {
        return $this->hasMany(Depense::class);
    }
}
