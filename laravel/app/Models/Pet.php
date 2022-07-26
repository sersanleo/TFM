<?php

namespace App\Models;

use App\Enum\Sexes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    use HasFactory;

    protected $fillable = [
        'annotations',
        'birthday',
        'name',
        'sex',
        'deceased',
        'race_id',
        'owner_id'
    ];

    protected $casts = [
        'birthday' => 'date:Y-m-d',
        'sex' => Sexes::class,
        'deceased' => 'boolean'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(PetRace::class);
    }

    public function scopeVisibleBy($query, User $user)
    {
        if ($user->is_staff)
            return $query;
        return $query->where('owner_id', $user->id);
    }

    public function __toString()
    {
        return $this->name . ' (' . $this->owner . ')';
    }
}
