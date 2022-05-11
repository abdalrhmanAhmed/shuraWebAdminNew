<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function dark_mode_on(Request $request){
        $request->session()->put('dark_mode','on'); 
        return redirect()->back();
    }
    public function dark_mode_off(Request $request){
        $request->session()->forget('dark_mode'); 
        return redirect()->back();

    }
}
