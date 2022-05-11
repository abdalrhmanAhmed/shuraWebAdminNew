<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\Models\Client;
use App\Models\Console;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    } 
    
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    // public function updateMode()
    // {
    //     $this->$updateMode=true;
    // }
    //store user function
    public function store(userRequest $request)
    {
        $validated = $request->validated();
        if($request->password == $request->password2)
        {
            $user = new User();
            $user->name = $request->name;
            // $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->isActive = $request->isActive;
            $user->type = $request->type;
            $user->gendor = $request->gendor;
            $user->country = $request->country;
            if($request->hasFile('photo'))
            {
                $image = $request->photo;
                $imageExt = $image->getClientOriginalExtension();
                $imageName = now().'.'.$imageExt;
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
            session()->flash('addUser'); #notify
            return redirect()->back();
        }else{
            session()->flash('error_password');
            return redirect()->back();
        }
    }

    public function profile()
    {
        $user = Auth::user()->id;
        $profile = User::where('id', $user)->first();
        return view('users.profile', compact('profile'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('users.showUser', compact('user'));
    }

    public function update(Request $request)
    {
        if($request->password == $request->password2)
        {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gendor = $request->gendor;
        $user->isActive = $request->isActive;
        $user->country = $request->country;
        $user->phone = $request->phone;
        $user->type = $request->type;
        if($request->hasFile('photo'))
        {
            $destination = $user->photo;
            if(File::exists($destination))
            {   
                File::delete($destination);
            }
            $image = $request->photo;
            $imageExt = $image->getClientOriginalExtension();
            $imageName = now().'.'.$imageExt;
            $image->move('upload/userPhoto/',$imageName);
            $user->photo = 'upload/userPhoto/'.$imageName;
        }
        $user->update();
        
        session()->flash('updateUser');
        return redirect()->back();
        }else{
            session()->flash('error_password');
            return redirect()->back();
        }

    }

    public function destroy(Request $request)
    {
        
        $user = User::findOrFail($request->id);
        $destination = $user->photo;
            if(File::exists($destination))
            {   
                File::delete($destination);
            }
        $user->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
