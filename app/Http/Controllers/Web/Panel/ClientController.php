<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('name', 'asc')->paginate();

        return Inertia::render('Panel/Clients/Index', [
            'clients' => ClientResource::collection($clients),
        ]);
    }

    public function create()
    {
        return Inertia::render('Panel/Clients/Create');
    }

    public function store(ClientRequest $request)
    {
        $data = $request->only('name', 'contact', 'email');

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function edit($id)
    {
        $client = Client::find($id);

        if(!$client)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        return Inertia::render('Panel/Clients/Edit', [
            'client' => $client,
        ]);
    }

    public function update(ClientRequest $request, $id)
    {
        $client     = Client::find($id);
        $data       = $request->only('name', 'contact', 'email');

        if(!$client)
            return redirect()->back()->with('failed', 'Dados não encontrados!');

        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Edição realizada com sucesso!');
    }
}
