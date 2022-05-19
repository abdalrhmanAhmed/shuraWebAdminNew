<?php

namespace App\Http\Controllers\catiguries;

use App\Http\Controllers\Controller;
use App\Models\Catiguries;
use App\Http\Requests\catiguriesRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CatiguriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catiguries = Catiguries::all();
        return view('catiguries.catiguries', compact('catiguries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(catiguriesRequest $request)
    {
        try{
            $validated = $request->validated();
            $catiguries = new Catiguries();
            $catiguries->name = $request->name;
            $catiguries->description = $request->description;
            if($request->hasFile('icon'))
            {
                $image = $request->icon;
                $imageExt = $image->getClientOriginalExtension();
                $imageName = now().'.'.$imageExt;
                $image->move('upload/catiguriesIcon/',$imageName);
                $catiguries->icon = 'upload/catiguriesIcon/'.$imageName;
            }
            $catiguries->save();
            session()->flash('success');
            return redirect()->back();
        }//end of try

        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }//end of catch
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catiguries  $catiguries
     * @return \Illuminate\Http\Response
     */
    public function show(Catiguries $catiguries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catiguries  $catiguries
     * @return \Illuminate\Http\Response
     */
    public function edit(Catiguries $catiguries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catiguries  $catiguries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $catiguries = Catiguries::where('id', $request->id)->first();
        $catiguries->name = $request->name;
        $catiguries->description = $request->description;

        if($request->hasFile('icon'))
        {
            $destination = $catiguries->icon;
            if(File::exists($destination))
            {   
                File::delete($destination);
            }
            $image = $request->icon;
            $imageExt = $image->getClientOriginalExtension();
            $imageName = now().'.'.$imageExt;
            $image->move('upload/catiguriesIcon/',$imageName);
            $catiguries->icon = 'upload/catiguriesIcon/'.$imageName;
        }

        $catiguries->update();
        session()->flash('update');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catiguries  $catiguries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $catiguries = Catiguries::findOrFail($request->id);
        $catiguries->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
