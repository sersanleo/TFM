<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRace extends Model
{
    use HasFactory;

    protected $hidden = ['species_id'];

    protected $with = ['species'];

    public function species()
    {
        return $this->belongsTo(PetSpecies::class);
    }

    public function __toString()
    {
        return strlen($this->race) > 0  ? $this->species->name . ' (' . $this->race . ')' : $this->species->name;
    }
}
