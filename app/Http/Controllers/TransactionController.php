<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Transaction;
use App\Transaction_detail;
use App\Outlet;
use App\Member;
use App\Package;

use PDF;
class TransactionController extends Controller
{
    public function index()
    {
        if(auth()->user()->outlet == NULL){
             $transactions = Transaction::with(['member','outlet'])
                            ->orderBy('created_at','DESC')->paginate(5);
        }else{
             $transactions = Transaction::with(['member','outlet'])
                             ->where('outlet_id', auth()->user()->outlet_id)
                             ->orderBy('created_at','DESC')->paginate(5);
        }
        
        $members      = Member::orderBy('created_at','DESC')->get();
        return view('transactions.index', compact('members','transactions'));
    }

    public function create(Request $req)
    {

        $this->validate($req,[
            'member_id'  => 'required'
        ]);

        try {   
            $invoice = 'LI-'.date('dmYHis');        
            $transaction = Transaction::updateOrCreate([
            'member_id'=> $req->member_id,
            'user_id'  => auth()->user()->id,
            'invoice'  => $invoice,
            'status'   => 'Baru',
            'paid'     => 'Belum dibayar',
            'total'    => 0
            ]);
            return redirect(route('transaction.edit',['id' => $transaction->id]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit(Request $req, $id)
    {
        $transactions = Transaction::with('member','outlet','detail','detail.package')->find($id);
        
        $transaction_detail  = Transaction_detail::where('transaction_id', $transactions->id)->get();
        $subtotal = $transaction_detail->sum(function($i){
            return $i->qty * $i->price;
        }); 

        if(auth()->user()->outlet_id == NULL){
              $outlets      = Outlet::all();
              $packages     = Package::all();
        }else{
              $outlets      = Outlet::where('id',auth()->user()->outlet_id)->first();
              $packages     = Package::where('outlet_id',auth()->user()->outlet_id)->get();
            
        }

        return view('transactions.edit', compact('transactions','packages','outlets','subtotal'));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'outlet_id'  => 'required',
            'package_id' => 'required',
            'date'       => 'required',
            'qty'        => 'required',
        ]);
        
        try {
            $transaction        = Transaction::find($id);
            $package            = Package::find($req->package_id);
            $transaction_detail = $transaction->detail()->where('package_id', $package->id)->first();
          
            if ($transaction_detail) {
                $transaction_detail->update([
                    'qty' => $transaction_detail->qty + $req->qty,
                ]);
                 return redirect()->back()->with('success', 'Berhasil menambah item');
            }else{
                if($transaction->expired == NULL ){
                    $transaction->update([
                    'outlet_id' => $req->outlet_id,
                    'date'      => $req->date,
                    'expired'   => date('Y-m-d', strtotime($req->date. "+7 days")),
                    'status'    => 'Baru',
                    'paid'      => 'Belum dibayar'                    
                 ]);
                
            }

                Transaction_detail::create([
                    'transaction_id' => $transaction->id,
                    'package_id'     => $req->package_id,
                    'qty'            => $req->qty,
                    'price'          => $package->price,
                ]);
                return redirect()->back()->with('success', 'Berhasil menambah item');
            }
        } catch (\Throwable $th) {
          return  back()->with('error', $th->getMessage());
        }
    }

    public function save(Request $req, $id)
    {
        
        
        try {
            $transaction = Transaction::find($id);

            if($req->total == 0){
                return back()->with('error','Pilih paket terlebih dahulu');
            }else{
                 if($req->payment_date != NULL){
                $transaction->update([
                    'payment_date'      => $req->payment_date,
                    'additional_cost'   => $req->additional_cost,
                    'discount'          => $req->discount,
                    'tax'               => $req->tax,
                    'paid'              => 'Dibayar',
                    'total'             => $req->total,
                    'note'              => $req->note
                 ]);    
            }else{
                 $transaction->update([
                    'payment_date'      => $req->payment_date,
                    'additional_cost'   => $req->additional_cost,
                    'discount'          => $req->discount,
                    'tax'               => $req->tax,
                    'total'             => $req->total,
                    'note'              => $req->note
                 ]);    
            }
            return redirect('transaction')->with('success','Berhasil menyimpan pesanan');
            }
           
        } catch (\Throwable $th) {
            return back()->with('error', $th->getmessage());
        }
    }

    public function getPackage()
    {
        $package = Package::where('outlet_id', request()->outlet_id)->get();
        return response()->json(['status'=>'success', 'data' => $package]);
    }

    public function getPrice($id)
    {
        $price = Package::where('id',$id)->first();
        return response()->json($price);
    }

    public function deleteItem($id)
    {
        $item = Transaction_detail::find($id);
        $item->delete();
        return back()->with('success','Berhasil menghapus item');
    }

    public function updateItem($id)
    {
        $item = Transaction_detail::with(['package'])->find($id);
        return view('transactions.update', compact('item'));
    }

    public function saveUpdate(Request $req, $id)
    {
            $item = Transaction_detail::find($id); 
            ($req->qty == 0 ? $item->delete() : $item->update(['qty'=>$req->qty]));
           return back()->with('success','Berhasil mengupdate item');
    }


    public function cancelOrder($id)
    {
        $order = Transaction::findOrFail($id);
        $order->delete();
        return redirect('transaction')->with('success','Pesanan berhasil dibatalkan');
    }

    public function detailOrder($id)
    {
           $order    = Transaction::with(['member','outlet','detail','user','detail.package'])->find($id);
           $transaction_detail  = Transaction_detail::where('transaction_id', $order->id)->get();
           $subtotal = $transaction_detail->sum(function($i){
                return $i->qty * $i->price;
           }); 
           return view('transactions.detail', compact('order','subtotal'));
    }

    public function saveUpdateOrder(Request $req, $id)
    {
        $order = Transaction::findOrFail($id);

        
        if($req->status == 'Diambil' && $req->payment_date == NULL){
            return back()->with('error','Silahkan untuk membayar pesanan terlebih dahulu');
        }else{
            if($req->payment_date == NULL){
                $order->update([
                'status'       => $req->status
                ]);
            }else{
                 $order->update([
                'payment_date' => $req->payment_date,
                'status'       => $req->status,
                'paid'         => 'Dibayar'
                ]);
            }
        }
        return back()->with('success','Berhasil mengupdate pesanan');   
        
    }

    public function genarateTransaction($id)
    {
        $transactions        = Transaction::with('detail','member','outlet','detail.package')->find($id);
        $transaction_detail  = Transaction_detail::where('transaction_id', $transactions->id)->get();
        $subtotal            = $transaction_detail->sum(function($i){
                                    return $i->qty * $i->price;
                                }); 
        $pdf                 = PDF::loadview('transactions.print', compact('transactions','subtotal'))
                               ->setPaper('a4','landscape');
        return $pdf->stream();
    }

  


    

}
