<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return Inertia::render('Panel/Clients/Index', [
            'clients' => $clients,
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
}
