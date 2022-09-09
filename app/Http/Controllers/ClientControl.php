<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientControl extends Controller
{
    //
    public function index(){
        return response()->json(Client::all(),200);
    }
    public function create(){

    }
    public function store(Request $request){
        $data = $request->validate(
            [
        'Firstname'=>'required',
        'Lastname'=>'required',
        'Cash_Paid_Frw'=>'required',
        'Status_Payment'=>'required',
        'Quantity_Paid_For'=>'required',
        'Description_Work'=>'required',
            ]
            );
        $client = Client::create($data);
        return response()->json($client,200);
    }
}
