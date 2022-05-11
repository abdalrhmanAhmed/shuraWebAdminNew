<?php

namespace App\Http\Controllers\Api\catiguriesServices;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Catiguries;
use App\Http\Requests\catiguriesRequest;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatiguriesController extends Controller
{
    use apiResponseTrait;    
    /**
     * getCatiguries
     *
     * @return void
     */
    public function getCatiguries()
    {
        $catiguries = Catiguries::all();

        if($catiguries){
            return $this->apiResponse($catiguries,'All Catiguries Getted',200);
        }else{
            return $this->apiResponse(null,'No Catiguries To Get',404);
        }
    }
    
    /**
     * getServices
     *
     * @param  mixed $request
     * @return void
     */
    public function getServices(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'categurie_id'=> 'required',
        ]);

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        };
        $services = Service::where('categurie_id',$request->categurie_id)->get();
        
        if($services->count() > 0){
            return $this->apiResponse($services,'All Services Getted',200);
        }else{
            return $this->apiResponse(null,'No Services To Get',404);
        }
    }  
}
