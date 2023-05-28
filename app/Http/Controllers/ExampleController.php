<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use App\User;
use App\Models\OrdersModel;
use Excel;
use App\Exports\OrdersExport;
use App\Imports\ProductImport;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    /**
 * @var \Tymon\JWTAuth\JWTAuth
 */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        try { 

            $token = $this->jwt->attempt($request->only('email', 'password'));
             if (!$token ) {
                 return response()->json(['user_not_found'], 401);
             }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
        $user = User::where('email', '=', $request->post('email'))->first();
        $data = array(
            "token" => $token,
            "user" => $user,
        );
        return response()->json($data,200);
    }

    public function save()
    {
        DB::table('users')->insert(
            array(
                'name' => 'sam',
                'email' => 'sam@mail.com',
                'password' => \Hash::make("sam1"),
            )
        );
    }
  
    public function test()
    {

        $token = $this->jwt->getToken();
        $this->jwt->user();
        $data = $this->jwt->setToken($token)->toUser();
        return response()->json(['data' => $data], 200);
    }

    public function Myfirstfunction(Request $request)
    {
        echo view('test'); 
    }
   
    public function HelloWorld(Request $request)
    {
        echo 1;
    }
 
    public function mysessiondata(Request $request)
    {
      $request->session()->put('name', rand(100000,999999));
        if ($request->session()->has('name')) {
           echo  $request->session()->get('name');exit;
        }
        echo view('test'); 
    }
 
   public function GetUser(Request $request)
   {
    $users = User::all();
    return $users;
   }  

public function AllProducts(Request $request)
{
   try {
        $list = OrdersModel::orderBy('id','desc')->paginate(10);
        $data= array('list'=>$list);
        return view('produccts-list',$data);
   } catch (\Throwable $th) {
     echo $th->getMessage(); 
   }
} 
 
 
public function ExportAllProducts(Request $request)
{ 
   try {
        $list = OrdersModel::orderBy('id','desc')->get();
        $data= array('list'=>$list);
        ob_end_clean(); 
        ob_start(); 
        return Excel::download(new OrdersExport($data),"all-products".rand(999,100).".xlsx",\Maatwebsite\Excel\Excel::XLSX);
   } catch (\Throwable $th) {
     echo $th->getMessage(); 
   }
} 


public function ImportProducts(Request $request)
{
    try {
        $insert = array();
    if($request->hasFile('import_file')){

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::toArray([],  $request->file('import_file'));
        // $data = Excel::import(new ProductImport,  $request->file('import_file'));
        echo "<pre>";
        print_r($data);exit;
        // if(!empty($data) && $data->count()){

        //     foreach ($data->toArray() as $key => $value) {

        //         if(!empty($value)){

        //             foreach ($value as $v) {        

        //                 $row= [
        //                     'ID' => $v['ID'], 
        //                     'PRODUCT NAME' => $v['PRODUCT NAME'],
        //                     'QUANTITY' => $v['QUANTITY'],
        //                     'CREATED AT' => $v['CREATED AT'],
        //                     'UPDATED AT' => $v['UPDATED AT'],
        //                 ];
        //                 array_push($insert,$row);
        //             }
        //         }
        //     }

        //     if(count($insert) > 0){
        //         echo "<pre>";
        //         print_r($insert);
        //         echo "<pre>";
        //     } else {
        //        echo "nothing for import."; 
        //     }
        // }
    }
    return redirect(route('all-products'))->with('error','Please Check your file, Something is wrong there.');
   } catch (\Throwable $th) {
     echo $th->getMessage(); 
   }
}








}