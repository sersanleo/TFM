<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum Sexes: String
{
    case Male = 'male';
    case Female = 'female';
}

class Pet extends Model
{
    use HasFactory;

    protected $casts = [
        'birthday' => 'date:Y-m-d',
        //'sex' => Sexes::class,
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(PetRace::class);
    }
}
