<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Outlet;
use App\Member;
use App\User;
use App\Transaction;
use App\Transaction_detail;
class DashboardController extends Controller
{
  
    public function index()
    {
      
        if(auth()->user()->outlet == NULL){
            $order         = Transaction::with(['member','outlet'])
                                ->where('status','Baru')
                                ->orderBy('created_at','DESC')
                                ->take(3)
                                ->get();
            $orderComplated = Transaction::where('status','selesai')
                                ->count();
        }else{
            $order     =     Transaction::with(['member','outlet'])
                            ->where(['status'=>'Baru','outlet_id'=>auth()->user()->outlet_id])
                            ->orderBy('created_at','DESC')
                            ->take(3)
                            ->get();
            $orderComplated = Transaction::where(['status'=>'selesai','outlet_id'=> auth()->user()  ->outlet_id])  ->count();
        }

        $outlet   = Outlet::count();
        $member   = Member::count();
        $user     = User  ::count();

        $proses   = Transaction::where(['status'=>'proses','outlet_id'=> auth()->user()->outlet_id])
                                 ->count();
        $baru     = Transaction::where(['status'=>'baru','outlet_id'=> auth()->user()->outlet_id])
                                 ->count();
        $diambil  = Transaction::where(['status'=>'diambil','outlet_id'=> auth()->user()->outlet_id])
                                 ->count();

        $pendapatan = Transaction::where('paid','dibayar')
                                  ->sum('total');
        
        
        // Owner 
        
        $cabang   = Outlet::all();
        $pengguna = User::all();
        $pelanggan= Member::all();
        $income   = Transaction::with(['member','outlet'])
                    ->where('paid','dibayar')
                    ->get();


        return view('dashboard', compact('outlet','member','user','orderComplated','order','proses','baru','diambil','pendapatan','cabang','pengguna','pelanggan','income'));
    }
}
