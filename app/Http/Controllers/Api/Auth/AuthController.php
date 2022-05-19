<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Services\SMSGateways\mazenHostGateway;
use App\Http\Services\verficationServices;
use App\Models\Client;
use App\Models\Console;
use App\Models\ConsoleFiles;
use App\Models\User;
use App\Models\User_verfication;
use App\Models\Wallet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public $smsservices;
    public function __construct(verficationServices $smsservices) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'consoleRegister', 'verficationCode', 'checkOTP', 'changePassword']]);
        $this->smsservices = $smsservices;
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
            ####################insert user photo#################################3
            if ($files = $request->file('photo')) {
                //store file into document folder
                $file = $request->photo->store('public/upload/catiguriesIcon');
                //store your file into database
                $user->photo = $file;
            }
            $user->save();
            #insert user wallet
            $user_id = $user->id;
            if($user->type != 0)
            {
                $wallet_id = Helper::IDGenerator(new Wallet(), 'wallet_id', 5, 'STD');
                $wallet = new Wallet();
                $wallet->user_id = $user_id;
                $wallet->wallet_id = $wallet_id;
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
            'email'=> 'required|email',
            'password'=> 'required',
            'phone' => 'required|unique:users',
            'country'=>'required',
            'gendor'=>'required',
            'category' => 'required',
            'services' => 'required',
            'certificate' => 'required',
            'cv' => 'required'
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->isActive = 1;
            $user->type = 1;
            $user->gendor = $request->gendor;
            $user->country = $request->country;
            ####################insert user photo#################################3
            if ($files = $request->file('photos')) {
                //store file into document folder
                $file = $request->photos->store('public/upload/catiguriesIcon');
                //store your file into database
                $user->photo = $file;
            }
            $user->save();
            //create console wallet
            $wallet_id = Helper::IDGenerator(new Wallet(), 'wallet_id', 5, 'STD');
            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->wallet_id = $wallet_id;
            $wallet->amount = 0;
            $wallet->save();

            //create console profile
            $profile = new Console();
            $profile->user_id = $user->id;
            $profile->category = $request->categories;
            $profile->save();
            $profile->services()->syncWithoutDetaching($request->services);
            ###################start isert image###########################
            if ($request->file('certificate') && $request->file('cv')) {
                //store file into document folder
                $certificate = $request->certificate->store('public/upload/consoleFiles');
                $cv = $request->cv->store('public/upload/consoleFiles');
                //store your file into database
                $document = new ConsoleFiles();
                $document->console_id = $user->id;
                $document->certificate = $certificate;
                $document->cv = $cv;
                $document->save();
            }
            DB::commit();
            return $this->apiResponse($user,'User Registerd Successfully',201);
        }catch(\Exception $e){
            DB::rollBack();
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

    ##############################create and send OTP as sms#########################################
    public function verficationCode(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'phone' => 'required',
        ]);//end of validator
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }//end of validation error
        $verfication  = [];
        $user = User::where('phone', $request->phone)->first();
        if($user)
        {
            $verfication['user_id'] = $user->id;
            $verfication_data = $this->smsservices->setVerficationCode($verfication);
            //send sms 
            app(mazenHostGateway::class)->sendSMS($user, $verfication_data->verfication_code);

            return $this->apiResponse($user,'verfication code created Successfully',201);
        }else{
            return $this->apiResponse(null,'user not found',400);
        }//end of if else 
    }//end of verfication code

    ##############################check OTP#########################################
    public function checkOTP(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'verfication_code' => 'required',
            'phone' => 'required',
        ]);//end of validator
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }//end of validation error
        $user = User::where('phone', $request->phone)->first();
        $verfication = User_verfication::where('user_id', $user->id)->first();
        if($verfication->verfication_code == $request->verfication_code)
        {
            return $this->apiResponse(null, true, 200);
        }else{
            return $this->apiResponse(null, 'الرمز غير صحيح الرجاء المحاولة مرة أخرى', 400);
        }//end of if else
    }//end of check OTP

    ##############################change password#########################################
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required',
        ]);//end of validator
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }//end of validation error

        $user = User::where('phone', $request->phone)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return $this->apiResponse(null,'password updated successfully',204);
    }
}