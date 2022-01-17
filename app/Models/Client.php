<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    # Traits
    use HasFactory;


    # Atributos
    protected $fillable = ['name', 'contact', 'email'];


    # Relacionamentos
    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }
}
