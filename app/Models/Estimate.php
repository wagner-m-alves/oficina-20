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


    # Métodos
    public function search(array $data)
    {
        $client     = isset($data['client']) ? $data['client'] : '';
        $employee   = isset($data['employee']) ? $data['employee'] : '';;
        $dtInitial  = isset($data['dtInitial']) ? $data['dtInitial'] : '';;
        $dtFinal    = isset($data['dtFinal']) ? $data['dtFinal'] : '';;

        $results = $this->join('clients', 'clients.id', '=', 'estimates.client_id')
                        ->join('employees', 'employees.id', '=', 'estimates.employee_id')
                        ->select('estimates.*')
                        ->where(function ($query) use($client) {
                            if($client){
                                $query->where('clients.name', 'LIKE', "%{$client}%");
                            }
                        })
                        ->orWhere(function ($query) use($employee) {
                            if($employee){
                                $query->where('employees.name', 'LIKE', "%{$employee}%");
                            }
                        })
                        ->orWhere(function ($query) use($dtInitial, $dtFinal) {
                            if($dtInitial && $dtFinal){
                                $query->whereDate('estimates.created_at', '>=', $dtInitial);
                                $query->whereDate('estimates.created_at', '<=', $dtFinal);
                            }
                        })
                        ->orderBy('estimates.created_at', 'desc')
                        ->paginate();

        return $results;
    }


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
