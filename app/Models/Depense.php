<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Depense extends Model
{
    protected $fillable = ['titre','montant','date','payer_id'];

    
    protected static function booted()
    {
        static::creating(function($depense){
            if(!$depense->colocation_id && $depense->category){
                $depense->colocation_id = $depense->category->colocation_id;
            }
        });
    }

    function Payer(){
        return User::find($this->payer_id);
    }

    public function colocation():BelongsTo{
        return $this->belongsTo(Colocation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
}
