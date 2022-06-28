<?php

namespace App\Http\Controllers\console;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Catiguries;
use App\Models\Console;
use App\Models\ConsoleFiles;
use App\Models\Service;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class consoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    } 

    public function index()
    {
        $consoles = Console::all();
        $users = User::where('type', 1)->get();
        $categories = Catiguries::all();
        return view('users/consoles/index', compact('consoles', 'categories','users'));
    }//end of index

    public function getServices($id)
    {
        $services = Service::where('categurie_id', $id)->pluck('name', 'id');
        return $services;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed',
                'phone' => 'required|unique:users',
                'gendor' => 'required',
                'country' => 'required',
            ]);
            //create console in user table
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->gendor = $request->gendor;
            $user->country = $request->country;
            $user->isActive = 1;
            $user->type = 1;
            ####################insert user photo#################################3
            if ($files = $request->file('photo')) {
                //store file into document folder
                $file = $request->file('photo');
                // $file = $request->photo->store('/upload/catiguriesIcon');
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/upload/userPhoto', $name);  
                //store your file into database
                $user->photo = $name;
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

            // if($request->hasfile('photos'))
            // {
            //     foreach($request->file('photos') as $file)
            //     {
            //         $name=$file->getClientOriginalName();
            //         $file->move(public_path().'/upload/consoleFiles', $name);  
            //         $data[] = $name;  
            //     }//end of foreach
            // }//end of if
            // $file= new ConsoleFiles();
            // $file->console_id = $profile->id;
            // $file->file_name=json_encode($data);
            // $file->save();

            DB::commit();
            session()->flash('success'); #notification
            return redirect()->back();
        }//end of try
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }//end of catch
    }//end of store

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->gendor = $request->gendor;
        $user->country = $request->country;
        $user->isActive = $request->status;
        if ($files = $request->file('photo')) {
            //store file into document folder
            $file = $request->file('photo');
            // $file = $request->photo->store('/upload/catiguriesIcon');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/upload/userPhoto', $name);  
            //store your file into database
            $user->photo = $name;
        }
        $user->update();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $console = User::where('id', $id)->first();
        $console->delete();
        session()->flash('delete'); #notification
        return redirect()->back();
    }
}
