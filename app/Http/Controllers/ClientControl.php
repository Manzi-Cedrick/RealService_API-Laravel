<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientDataRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientControl extends Controller
{
    //
    public function index(){
        return response()->json(Client::all(),200);
    }
    public function store(ClientDataRequest $request){
        $client = Client::create($request->all());
        return response()->json([
            'status' => 200,
            'message ' => 'Client successfully registered',
            'Client' => $client
        ]);
    }
    public function update(ClientDataRequest $request,Client $client){
        $client->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Client successfully Updated',
            'Client' => $client,
        ],200);
    }
    public function destroy(Client $client){
        $client->delete();
        return response()->json([
            'status' => true,
            'message' => 'Client successfully Deleted',
            'Client' => $client,
        ],200);
    }
    public function ShowSingleClient(Client $client){
        $singleClient = Client::find($client);
        return response()->json([
            'status' => true,
            'message' => 'Client successfully Displayed',
            'Client' => $singleClient,
        ],200);
    }
}
