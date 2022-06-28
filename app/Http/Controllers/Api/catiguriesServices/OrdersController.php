<?php

namespace App\Http\Controllers\Api\catiguriesServices;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\AvailableTime;
use App\Models\Console;
use App\Models\ConsoleServices;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    public function get_console_orders()
    {
       
        try{
            $consoleId = auth()->user()->profile->id;
            $console = Console::Find($consoleId);
            $array= array();
            foreach($console->consoleServices as $item){
                $array[] = $item->id;
            }
            $orders = Order::whereIntegerInRaw('console_service_id',$array)->get();
            $data = array();
            $fullOrdersData = array();
            foreach($orders as $order){
                $fullOrdersData['order_id'] = $order->id;
                $fullOrdersData['status'] = $order->status;
                $fullOrdersData['Time'] = $order->AvailableTime()->select('day','from','to')->first();
                $fullOrdersData['service'] = $order->ConsoleService->service->name;
                $fullOrdersData['client'] = User::Select('name','photo')->Find($order->user_id);
                $data[] = $fullOrdersData;
            }
            
            return $this->apiResponse($data,'Orders Details',200);


        }catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }

    public function get_client_orders()
    {
       
        try{
             $orders = Order::where('user_id',auth()->user()->id)->get();
             if($orders->count() == 0 ){
                return $this->apiResponse(null,'No Data To Show',404);
             }
            $data = array();
            $fullOrdersData = array();
            foreach($orders as $order){
                $fullOrdersData['order_id'] = $order->id;
                $fullOrdersData['status'] = $order->status;
                $fullOrdersData['Time'] = $order->AvailableTime()->select('day','from','to')->first();
                $fullOrdersData['service'] = $order->ConsoleService->service->name;
                $fullOrdersData['console'] = $order->ConsoleService->console->user->select('name','photo')->first();
                $data[] = $fullOrdersData;
            }
            
            return $this->apiResponse($data,'Orders Details',200);
        }catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function confirm_order(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        try{
            $order = Order::Find($request->order_id);
            if($order->count() > 0){
                if($order->status == 0){
                    $order->update(['status' => 1,]);
                    return $this->apiResponse(null,'success',200);
                }
                return $this->apiResponse(null,'The Case Is Already Confirmed',400);

            }
        }catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }

    public function reject_order(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        try{
            $order = Order::Find($request->order_id);
            if($order->count() > 0){
                if($order->status == 0){
                    $order->update(['status' => -1,]);
                    return $this->apiResponse(null,'success',200);
                }
                return $this->apiResponse(null,'The Case Is Already Confirmed',400);

            }
        }catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }
}
