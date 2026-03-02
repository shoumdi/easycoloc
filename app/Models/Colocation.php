<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colocation extends Model
{

protected $fillable = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) $model->created_by = auth()->user()->id;
        });
    }
    function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'colocation_member');
    }
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function depenses(): HasMany
    {
        return $this->hasMany(Depense::class);
    }
     public function depts(): HasMany
    {
        return $this->hasMany(Dept::class);
    }
    public function invitations():HasMany{
        return $this->hasMany(Invitation::class);
    }
}
