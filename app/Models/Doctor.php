<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'specialization', 'phone' ,'email', 'foto'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

