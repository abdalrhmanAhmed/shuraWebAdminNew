<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Console;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use apiResponseTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        if (! $token = auth()->attempt($validator->validated()))
        {
            return $this->apiResponse(null,'Unauthorized',401);
        }
        $token =  $this->createNewToken($token);
        $token = $token->original['access_token'];
        $user = User::with('wallet','profile')->Find(auth()->user()->id)->toArray();
        $userData = array('token' => $token,'user'=>$user);
        return $this->apiResponse($userData,'success',200);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|unique:users|email',
            'password'=> 'required',
            'phone'=> 'required',
            'country'=>'required',
            'gendor'=>'required'
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->isActive = 0;
            $user->type = 2;
            $user->gendor = $request->gendor;
            $user->country = $request->country;
            if($request->hasFile('photo'))
            {
                $today = date('Ymd').time();
                $image = $request->photo;
                $imageExt = $image->getClientOriginalExtension();
                $imageName = $today.'.'.$imageExt;
                $image->move('upload/userPhoto/',$imageName);
                $user->photo = 'upload/userPhoto/'.$imageName;
            }
            $user->save();
            #insert user wallet
            $user_id = $user->id;
            if($user->type != 0)
            {
                $wallet = new Wallet();
                $wallet->user_id = $user_id;
                $wallet->amount = 0;
                $wallet->save();
            }
            #insert console defualt data
            if ($user->type == 1) {
                $console = new Console();
                $console->user_id = $user_id;
                $console->save();
            }

            #insert client defualt data
            if($user->type == 2)
            {
                $client = new Client();
                $client->user_id = $user_id;
                $client->save();
            }
            return $this->apiResponse($user,'User Registerd Successfully',201);
        }catch(\Exception $e){
            return $this->apiResponse(null,$e->getMessage(),400);
        }
    }




        /**
     * Register a Console.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function consoleRegister(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|unique:users|email',
            'password'=> 'required',
            'phone'=> 'required',
            'country'=>'required',
            'gendor'=>'required'
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->isActive = 0;
            $user->type = 2;
            $user->gendor = $request->gendor;
            $user->country = $request->country;
            if($request->hasFile('photo'))
            {
                $today = date('Ymd').time();
                $image = $request->photo;
                $imageExt = $image->getClientOriginalExtension();
                $imageName = $today.'.'.$imageExt;
                $image->move('upload/userPhoto/',$imageName);
                $user->photo = 'upload/userPhoto/'.$imageName;
            }
            $user->save();
            #insert user wallet
            $user_id = $user->id;
            if($user->type != 0)
            {
                $wallet = new Wallet();
                $wallet->user_id = $user_id;
                $wallet->amount = 0;
                $wallet->save();
            }
            #insert console defualt data
            if ($user->type == 1) {
                $console = new Console();
                $console->user_id = $user_id;
                $console->save();
            }

            #insert client defualt data
            if($user->type == 2)
            {
                $client = new Client();
                $client->user_id = $user_id;
                $client->save();
            }
            return $this->apiResponse($user,'User Registerd Successfully',201);
        }catch(\Exception $e){
            return $this->apiResponse(null,$e->getMessage(),400);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return $this->apiResponse(null,'User successfully signed out',200);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        try{
            return $this->apiResponse(auth()->user(),'user profile',200);
        }catch(\Exception $e){
            return $this->apiResponse(null,$e->getMessage(),400);
        }
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 180,
            'user' => auth()->user()
        ]);
    }
}