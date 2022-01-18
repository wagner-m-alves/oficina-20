<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstimateRequest;
use App\Http\Resources\{
    ClientResource,
    EstimateResource,
};
use App\Models\{
    Client,
    Estimate,
};
use Inertia\Inertia;

class EstimateController extends Controller
{
    public function index()
    {
        $estimates = Estimate::with('client', 'employee')->orderBy('created_at', 'desc')->paginate();

        return Inertia::render('Panel/Estimates/Index', [
            'estimates' => EstimateResource::collection($estimates),
        ]);
    }

    public function create()
    {
        $clients = Client::orderBy('name', 'asc')->get();

        return Inertia::render('Panel/Estimates/Create', [
            'clients' => ClientResource::collection($clients),
        ]);
    }

    public function store(EstimateRequest $request)
    {
        $data = $request->only('client_id', 'description', 'value');

        Estimate::create($data);

        return redirect()->route('estimates.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function edit($id)
    {
        $estimate   = Estimate::find($id);
        $clients    = Client::all();

        if(!$estimate)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        return Inertia::render('Panel/Estimates/Edit', [
            'estimate'      => $estimate,
            'clients'       => ClientResource::collection($clients),
        ]);
    }

    public function update(EstimateRequest $request, $id)
    {
        $estimate   = Estimate::find($id);
        $data       = $request->only('client_id', 'description', 'value');

        if(!$estimate)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        $estimate->update($data);

        return redirect()->route('estimates.index')->with('success', 'Edição realizada com sucesso!');
    }

    public function destroy($id)
    {
        $estimate = Estimate::find($id);

        if(!$estimate)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        $estimate->delete();

        return redirect()->route('estimates.index')->with('success', 'Deleção realizada com sucesso!');
    }
}
