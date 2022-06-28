<?php

namespace App\Http\Controllers\Api\console;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Http\Controllers\Api\apiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class consoleController extends Controller
{
    use apiResponseTrait;
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'required',
            'age' => 'required',
            'skills' => 'required',
            'education_degree' => 'required',
            'bank_name' => 'required',
            'bank_no' => 'required',
            'category' => 'required',
            'services' => 'required',
            'experiance' => 'required'
        ]);
        
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $services = [];
        $console = Console::where('user_id', auth()->user()->id)->first();
        $console->update([
            'bio' => $request->bio,
            'age' => $request->age,
            'skills' => $request->skills,
            'education_degree' => $request->education_degree,
            'bank_name' => $request->bank_name,
            'bank_no' => $request->bank_no,
            'category' => $request->category,
            'experiance' => $request->experiance,
            'description' => $request->description
        ]);
        $services[] = $request->services;
        $console->services()->syncWithoutDetaching($services);
        return $this->apiResponse($console,'console profile updated successfully',204);

    }
}
