<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return Inertia::render('Panel/Clients/Index', [
            'clients' => $clients
        ]);
    }
}
