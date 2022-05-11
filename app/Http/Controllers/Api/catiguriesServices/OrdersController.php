<?php

namespace App\Http\Controllers\Api\catiguriesServices;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\AvailableTime;
use App\Models\ConsoleServices;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    use apiResponseTrait;
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'console_service_id'=> 'required',
            'available_time_id'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        try{
            $service = $request->console_service_id;
            $time = $request->available_time_id;
            if(AvailableTime::Find($time) && ConsoleServices::Find($service))
            {
                $order = Order::create([
                    'console_service_id' => $service,
                    'user_id' => auth()->user()->id,
                    'available_time_id' => $time,
                    'status' => 0
                ]);
                return $this->apiResponse($order,'success',200);
            }
            return $this->apiResponse(null,'No Data For Avoilable Time || Console Services',404);


        }catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }
      
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
