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
}
