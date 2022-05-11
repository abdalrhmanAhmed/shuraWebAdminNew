<?php

namespace App\Http\Controllers\Api\catiguriesServices;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\ConsoleServices;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsoleServicesController extends Controller
{
    use apiResponseTrait; 
    /**
     * getServices
     *
     * @param  mixed $request
     * @return void
     */
    public function getServices(Request $request)
    {
        $services = Service::all();
        
        if($services->count() > 0){
            return $this->apiResponse($services,'All Services Getted',200);
        }else{
            return $this->apiResponse(null,'No Services To Get',404);
        }
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_id'=> 'required',
            'type' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        $validateService = ConsoleServices::where('console_id',auth()->user()->profile()->id)
                                            ->where('service_id',$request->service_id)
                                            ->where('type',$request->type)
                                            ->first();
        if(! $validateService){
            $service = ConsoleServices::create([
                'console_id' => auth()->user()->profile()->id,
                'service_id' => $request->service_id,
                'type' => $request->type,
                'price' => $request->price  
            ]);
            
            if($service){
                return $this->apiResponse($service,'All Services Getted',200);
            }else{
                return $this->apiResponse(null,'Somethings Went Wrong',400);
            }
        }else{
            return $this->apiResponse(null,'The Budget Allready Exist',400);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsoleServices  $consoleServices
     * @return \Illuminate\Http\Response
     */
    public function getConsoles(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_id'=> 'required',
        ]);

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        $consoles = ConsoleServices::with('console','user')->where('service_id',$request->service_id)->get();
        if($consoles->count() > 0 ){
            return $this->apiResponse($consoles,'consoles data with users',200);
        }
        return $this->apiResponse(null,'No Data Avoilable',404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsoleServices  $consoleServices
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsoleServices $consoleServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsoleServices  $consoleServices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsoleServices $consoleServices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsoleServices  $consoleServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsoleServices $consoleServices)
    {
        //
    }
}
