<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRace extends Model
{
    use HasFactory;

    protected $table = 'pet_race';

    public function species()
    {
        return $this->belongsTo(PetSpecies::class);
    }

    public function __toString()
    {
        return $this->race ? $this->species->name . ' (' . $this->race . ')' : $this->race;
    }
}
