<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetSpecies extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;

    protected $table = 'pet_species';
}
