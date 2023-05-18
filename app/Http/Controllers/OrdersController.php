<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\OrdersModel;
use App\Http\Helper\ResponseBuilder;
class OrdersController extends Controller
{


public function list(Request $request){
    try {
        $data = OrdersModel::all();
        // $info = "success";
        // $r = ResponseBuilder::result(200,$info,$data);
        return response()->json($data, 200)->header('Content-Type', 'json');
    } catch (\Throwable $th) {
        $error = $th;
        return response()->json($error, 400)->header('Content-Type', 'json');
    }
    

} 

public function neworder(Request $request){
 try {
    $product_name = $request->post('product_name');
    $quantity = (int) $request->post('quantity');
    $new = new OrdersModel;
    $new->product_name = $product_name;
    $new->quantity = $quantity;
    $new->save();
    $newid= $new->id;
    $response = array(
        'message'=>'success',
        'id'=>$newid,
    );
    return response()->json($response, 200)->header('Content-Type', 'json');
    } catch (\Throwable $th) {
        $error = $th;
        return response()->json($error, 400)->header('Content-Type', 'json');
    }
}


}
