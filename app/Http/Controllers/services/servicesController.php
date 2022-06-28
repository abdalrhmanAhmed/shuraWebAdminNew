<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\servicesRequest;
use App\Models\Catiguries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class servicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    } 
    public function index()
    {
        $services = Service::all();
        $categuries = Catiguries::all();
        return view('services.services', compact('services', 'categuries'));
    }

    public function store(servicesRequest $request)
    {
        $validated = $request->validated();
        $services = new Service();
        $services->name = $request->name;
        $services->categurie_id = $request->catigurie_id;
        $services->description = $request->description;
        if($request->hasFile('icon'))
        {
            $image = $request->icon;
            $imageExt = $image->getClientOriginalExtension();
            $imageName = now().'.'.$imageExt;
            $image->move('upload/servicesIcon/',$imageName);
            $services->icon = 'upload/servicesIcon/'.$imageName;
        }
        $services->save();
        session()->flash('success');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $services = Service::where('id', $request->id)->first();
        $services->name = $request->name;
        $services->description = $request->description;

        if($request->hasFile('icon'))
        {
            $destination = $services->icon;
            if(File::exists($destination))
            {   
                File::delete($destination);
            }
            $image = $request->icon;
            $imageExt = $image->getClientOriginalExtension();
            $imageName = now().'.'.$imageExt;
            $image->move('upload/servicesIcon/',$imageName);
            $services->icon = 'upload/servicesIcon/'.$imageName;
        }

        $services->update();
        session()->flash('update');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $services = Service::where('id', $request->id)->first();
        $services->delete();
        session()->flash('delete');
        return redirect()->back();
    }

}
