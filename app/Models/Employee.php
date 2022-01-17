<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    # Traits
    use HasFactory;


    # Atributos
    protected $fillable = ['name'];


    # Relacionamentos
    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }

    # Relacionamentos
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
