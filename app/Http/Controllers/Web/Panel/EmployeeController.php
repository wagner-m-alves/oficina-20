<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('name', 'asc')->paginate();

        return Inertia::render('Panel/Employees/Index', [
            'employees' => EmployeeResource::collection($employees),
        ]);
    }

    public function create()
    {
        return Inertia::render('Panel/Employees/Create');
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->only('name');

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);

        if(!$employee)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        return Inertia::render('Panel/Employees/Edit', [
            'employee' => $employee,
        ]);
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employee   = Employee::find($id);
        $data       = $request->only('name');

        if(!$employee)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Edição realizada com sucesso!');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if(!$employee)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Deleção realizada com sucesso!');
    }
}
