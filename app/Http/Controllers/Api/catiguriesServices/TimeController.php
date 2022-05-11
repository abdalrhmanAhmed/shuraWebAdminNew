<?php

namespace App\Http\Controllers\Api\catiguriesServices;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\Controller;
use App\Models\AvailableTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeController extends Controller
{
    use apiResponseTrait;    
    /**
     * consoleTime
     *
     * @param  mixed $request
     * @return void
     */
    public function consoleTime(Request $request){
        $validator = Validator::make($request->all(),[
            'console_id'=> 'required',
            'day'=> 'required',
            'from'=> 'required',
            'to'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        try{
            $consoleTime = AvailableTime::create($request->all());
            return $this->apiResponse($consoleTime,'Data Created Successfully',200);
        }
        catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }    
    /**
     * consoleTimeDestroy
     *
     * @param  mixed $request
     * @return void
     */
    public function consoleTimeDestroy(Request $request){
        $validator = Validator::make($request->all(),[
            'time_id'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        try{
            $user = auth()->user();
            AvailableTime::where('id',$request->time_id)->where('console_id',$user->id)->delete();
            return $this->apiResponse(null,'Data Deleted Successfully',200);
        }
        catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),400);
        }
    }
    public function showConsoleTime(Request $request){
        $validator = Validator::make($request->all(),[
            'console_id'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        try{
            $consoleTime = AvailableTime::where('console_id',$request->console_id)->get();
            if($consoleTime->count() > 0){
                return $this->apiResponse($consoleTime,'success',200);
            }else{
                return $this->apiResponse($consoleTime,'Console did not add avoilable Time',400);
            }
        }
        catch(Exception $e){
            return $this->apiResponse(null,$e->getMessage(),400);
        }
    }    
}
