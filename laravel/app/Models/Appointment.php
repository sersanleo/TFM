<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'vet_id',
        'date',
        'annotations'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    protected $hidden = ['pet_id'];

    protected $with = ['pet'];

    public function vet()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function scopeVisibleBy($query, User $user)
    {
        if ($user->is_staff)
            return $query;
        return $query->whereRelation('pet', 'owner_id', $user->id);
    }
}
