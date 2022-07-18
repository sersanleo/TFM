<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum Sexes: string
{
    case Male = 'male';
    case Female = 'female';
}

class Pet extends Model
{
    use HasFactory;

    public function appointments()
    {
        return $this->morphOne(Appointment::class, 'pet');
    }

    protected $casts = [
        'birthday' => 'date:Y-m-d',
        'sex' => Sexes::class,
    ];
}
