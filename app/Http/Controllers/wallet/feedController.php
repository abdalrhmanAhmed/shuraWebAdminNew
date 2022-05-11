<?php

namespace App\Http\Controllers\wallet;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class feedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::all();
        $wallets = Wallet::all();
        return view('wallet.feed_wallets.index', compact('feeds', 'wallets'));
    }//end of index

    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $feed_wallet = new Feed();
            $feed_wallet->sdgAmount = $request->sdgAmount;
            $feed_wallet->point_amount = $request->point_amount;
            $feed_wallet->wallet_id = $request->wallet_id;
            $feed_wallet->type = $request->type;
            $feed_wallet->entary_name = Auth::user()->name;
            $feed_wallet->save();
            
            //update amount on user wallet
            $wallets = Wallet::where('id', $request->wallet_id)->first();
            
            $wallets->amount = $request->point_amount;
            $wallets->update();
            DB::commit();
            session()->flash('success');
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
        try
        {
            $feed = Feed::where('id', $id)->first();
            $feed->sdgAmount = $request->sdgAmount;
            $feed->point_amount = $request->point_amount;
            $feed->wallet_id = $request->wallet_id;
            $feed->type = $request->type;
            $feed->entary_name = 2;
            $feed->update();
    
            session()->flash('update');
            return redirect()->back();
        }//end of try
        
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }//end of catch
    }//end of update

    public function destroy($id)
    {
        Feed::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }//end of destroy
}
