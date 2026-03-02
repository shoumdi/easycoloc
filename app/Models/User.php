<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DomainException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function isAdmin()
    {
        return $this->role()->pluck('name')[0] === 'Admin';
    }
    public function isOwner(){
         return $this->colocations()->where('status','ACTIVE')->first()->created_by === $this->id;
    }
    public function memberType(){
         return ($this->colocations()->where('status','ACTIVE')->first()->created_by === $this->id) ? 'Owner' : 'Member';
    }


    public function saveColocation(Colocation $coloc)
    {
        //  if (self::with(['colocations' => function ($q) {
        //     $q->where('status','ACTIVE')
        //         ->wherePivot('left_at', null)
        //         ->wherePivot('user_id', auth()->user()->id);
        // }])->exists()) throw new DomainException('User can\'t create more');
        return $this->colocations()->save($coloc);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function colocations(): BelongsToMany
    {
        return $this->belongsToMany(Colocation::class, 'colocation_member')
            ->withPivot(['left_at'])
            ->using(ColocationMember::class);
    }

    public function depts():HasMany{
        return $this->hasMany(Dept::class);
    }

    public function depenses():HasMany{
        return $this->hasMany(Depense::class);
    }
}
