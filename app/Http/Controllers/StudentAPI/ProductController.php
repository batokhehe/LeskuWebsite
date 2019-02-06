<?php

namespace App\Http\Controllers\StudentAPI;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Product; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class ProductController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->product_mdl =  new Product();
    }

	/** 
    * product api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function all(Request $request) 
    { 
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 
        $result = $this->product_mdl->all();

        return response()->json(
                $result
            , 
            $this->successStatus
        ); 
    }

    public function base64encoder(Request $request) 
    { 
        $input = $request->all();

        if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $image = base64_encode(file_get_contents($file));
                    echo $image;


                } catch (FileNotFoundException $e) {
                    echo "catch";

                }
            }
        }
    }
}
