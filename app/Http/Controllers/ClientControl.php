<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientDataRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientControl extends Controller
{
    //
        /**
     * @OA\Get(
     *     path="/api/clients",
     *     tags={"Client"},
     *     summary="Get all clients",
     *     description="Get all clients. Make sure you have a valid token",
     *     operationId="indexClient",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function indexClient(){
        return response()->json(Client::with('product')->get(),200);
    }
       /**
     * @OA\POST(
     *     path="/api/create/client",
     *     tags={"Client"},
     *     summary="Create client",
     *     description="Create Client. Make sure you have a valid token",
     *     operationId="storeClient",
     *     security={{"bearer_token":{}}},
     *  @OA\RequestBody(
     *      required=true,
     *      description="Enter valid credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"Firstname","Lastname","Cash_Paid_Frw","Status_Payment","Quantity_Paid_For","Description_Work"},
     *          @OA\Property(property="Firstname", type="string", format="name", example="Manzi"),
     *          @OA\Property(property="Lastname", type="string", format="name", example="Teteli"),
     *          @OA\Property(property="Cash_Paid_Frw", type="number", format="number", example="101.240"),
     *          @OA\Property(property="Status_Payment", type="string", format="string", example="Not Paid"),
     *          @OA\Property(property="Quantity_Paid_For", type="number", format="number", example=25),
     *          @OA\Property(property="Description_Work", type="string", format="string", example="Provident neque et ipsam magni quia neque. Error voluptatem delectus aut quia voluptatum. Ut assumenda quaerat vitae corporis dolorem."),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function storeClient(ClientDataRequest $request){
        $client = Client::create($request->all());
        return response()->json([
            'status' => 200,
            'message ' => 'Client successfully registered',
            'Client' => $client
        ]);
    }
           /**
     * @OA\PUT(
     *     path="/api/update/client/{client}",
     *     tags={"Client"},
     *     summary="Update client",
     *     description="Update Client. Make sure you have a valid token",
     *     operationId="updateClient",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="client",
     *         description="Select the client to updateClient",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *  @OA\RequestBody(
     *      required=true,
     *      description="Enter valid credentials. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character.",
     *      @OA\JsonContent(
     *          required={"Firstname","Lastname","Cash_Paid_Frw","Status_Payment","Quantity_Paid_For","Description_Work"},
     *          @OA\Property(property="Firstname", type="string", format="name", example="Manzi"),
     *          @OA\Property(property="Lastname", type="string", format="name", example="Teteli"),
     *          @OA\Property(property="Cash_Paid_Frw", type="number", format="number", example="101.240"),
     *          @OA\Property(property="Status_Payment", type="string", format="string", example="Not Paid"),
     *          @OA\Property(property="Quantity_Paid_For", type="number", format="number", example=25),
     *          @OA\Property(property="Description_Work", type="string", format="string", example="Provident neque et ipsam magni quia neque. Error voluptatem delectus aut quia voluptatum. Ut assumenda quaerat vitae corporis dolorem."),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function updateClient(ClientDataRequest $request,Client $client){
        $client->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Client successfully Updated',
            'Client' => $client,
        ],200);
    }
           /**
     * @OA\DELETE(
     *     path="/api/delete/client/{client}",
     *     tags={"Client"},
     *     summary="Delete client",
     *     description="Delete Client. Make sure you have a valid token",
     *     operationId="destroyClient",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="client",
     *         description="Select the client to update",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function destroyClient(Client $client){
        $client->delete();
        return response()->json([
            'status' => true,
            'message' => 'Client successfully Deleted',
            'Client' => $client,
        ],200);
    }
            /**
     * @OA\GET(
     *     path="/api/client/{client}",
     *     tags={"Client"},
     *     summary="View client",
     *     description="View Client Details. Make sure you have a valid token",
     *     operationId="ShowSingleClient",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="client",
     *         description="Select the client to update",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function ShowSingleClient(Client $client){
        $singleClient = Client::find($client->id)->product;
        return response()->json([
            'status' => true,
            'message' => 'Client successfully Displayed,Product List',
            'Client' => $singleClient,
        ],200);
    }
          /**
     * @OA\GET(
     *     path="/api/sales",
     *     tags={"Client"},
     *     summary="Sales Detail",
     *     description="Sales list. Make sure you have a valid token",
     *     operationId="AllSales",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function AllSales() {
        $AllSales = Client::with(['product'])->where('Status_Payment','Paid')->get();
        return response()->json([
            'status' => true,
            'message' => 'AllSales',
            'Sales Info'=> $AllSales,
        ],200);
    }
             /**
     * @OA\GET(
     *     path="/api/search/client",
     *     tags={"Client"},
     *     summary="Search client",
     *     description="Search Client names. Make sure you have a valid token",
     *     operationId="SearchListClient",
     *     security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *         name="client",
     *         description="Select the client to update",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ) 
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function SearchListClient(Request $request){
        $client_query= Client::with(['product']);
        if($request->keyword){
            $client_query->where('FirstName','LIKE','%'.$request->keyword.'%');
        }
        if($request->search){
            $client_query->whereHas('product',function ($query) use ($request){
                $query->where('ProductName','LIKE','%'.$request->search.'%');
            });
        }
        $searchList = $client_query->get();
        return response()->json([
            'status' => true,
            'message' => 'Searched Client',
            'SearchInfo' => $searchList
        ],200);
    }
}
