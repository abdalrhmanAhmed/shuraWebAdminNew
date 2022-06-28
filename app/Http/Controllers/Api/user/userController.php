<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Console;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    use apiResponseTrait;
        
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $users = Auth::user();
        
        return $this->apiResponse($users,'ok',200);
    }
    

    ######################### Update User Data ##################################    
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        try{
            $user =  User::find(auth()->user()->id);
            foreach($request->all() as $key => $value){
                $user->update([
                    $key => $value
                ]);
            return $this->apiResponse($user,'User Updated Successfully',200);

            }
        }catch(\Exception $e){
            $this->apiResponse(null,$e->getMessage(),400);
        }        
    }    
    /**
     * destroy
     *
     * @return void
     */
    public function destroy(){
        try{
            User::Find(auth()->user()->id)->delete();
            return $this->apiResponse(null,'User Deleted Successfully',200);
        }catch(\Exception $e){
            return $this->apiResponse(null,$e->getMessage(),404);
        }
    }
    
    /**
     * consoleLoad
     *
     * @param  mixed $request
     * @return void
     */
    public function consoleLoad(Request $request){
        if(Console::Find(auth()->user()->profile()->id)){
            try{
                $console =  Console::Find(auth()->user()->profile()->id);
                foreach($request->all() as $key => $value){
                    // return $key;
                    $console->update([
                        $key => $value
                    ]);
                }
                $console = Console::with('user','userWallet')->Find(auth()->user()->id);
                return $this->apiResponse($console,'Console Updated Successfully',200);
            }catch(\Exception $e)
            {
                $this->apiResponse(null,$e->getMessage(),400);
            }    
        }else{
            return $this->apiResponse(null,'No data available',404);
        }
        
    }    
    /**
     * clientLoad
     *
     * @param  mixed $request
     * @return void
     */
    public function clientLoad(Request $request){
        if(Client::Find(auth()->user()->profile()->id)){
            try{
                Client::Find(auth()->user()->profile()->id)->update([
                    'bio' => $request->bio,
                ]);
                $client = Client::with('user','userWallet')->Find(auth()->user()->id);
                return $this->apiResponse($client,'done',200);
            }catch(\Exception $e){
                return $this->apiResponse(null,$e->getMessage(),400);
            }
        }else{
            return $this->apiResponse(null,'No data available',404);
        }
        
    }
    public function get_wallet(){
        $Wallet = Wallet::where('user_id',auth()->user()->id)->get()->first();
        if($Wallet){
            return $this->apiResponse($Wallet,'Take the Dim wallet',200);
        }
        return $this->apiResponse(null,'No Data Available',404);
    }
}
