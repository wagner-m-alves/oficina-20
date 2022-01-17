<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    # Traits
    use HasFactory;


    # Atributos
    protected $fillable = ['client_id', 'employee_id', 'description', 'value'];


    # Relacionamentos
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
