<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use PDF;

use App\User;
use App\Outlet;
use App\Transaction;
use App\Package;
use App\Transaction_detail;
use App\Member;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with(['outlet'])->orderBy('created_at','DESC')->paginate(5);
       
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $outlets = Outlet::all();
        return view('user.create', compact('outlets'));
        
    }
    public function save(Request $req)
    {
       
        $this->validate($req,[
            'role'      => 'required',
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ]);

        try {
            $user = User::create([
            'outlet_id' => $req->outlet_id,
            'role'      => $req->role,
            'name'      => $req->name,
            'email'     => $req->email,
            'password'  => bcrypt($req->password),
            ]);
            return redirect('user')->with('success','Berhasil menambah data user');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function edit($id)
    {
        $user    = User  ::find($id);
        $outlets = Outlet::all();
        return view('user.edit', compact('user','outlets'));
    }

    public function update(Request $req, $id)
    {
       
        $this->validate($req,[
            'role'      => 'required',
            'name'      => 'required|string|max:100',
        
        ]);

        try {
            $user = User::findOrFail($id);
            $pw = !empty($req->password)? bcrypt($req->password): $user->password;
            $user->update([
            'outlet_id' => $req->outlet_id,
            'role'      => $req->role,
            'name'      => $req->name,
            'password'  => $pw,
            ]);
            return redirect('user')->with('success','Data user berhasil diubah');
        } catch (\Throwable $th) {
            return backt()->with('error',$th->getMessage());
        }
        
    }

    public function delete($id)
    {
        $user = User::find($id);
        if($user->role == 'admin'){
            return back()->with('error','user '.$user->name.' tidak dapat dihapus');
        }else{
            $user->delete();
        }
        return back()->with('success','Data berhasil dihapus');
    }

    public function logout()
    {
        Auth::logout();
        return \redirect('/');
    }

   


    public function laporan()
    {
        if(auth()->user()->outlet_id == NULL){
            $outlets = Outlet::all();
        }else{
            $outlets = User::with(['outlet'])->where('outlet_id', auth()->user()->outlet_id)->first();
           
        }
        return view('laporan.index', compact('outlets'));
    }

    public function report(Request $req)
    {
          
        $date_start = $req->date_start;
        $date_end   = $req->date_end;
      
        if($req->outlet_id == 'all'){
            $report = Transaction::with(['member','outlet','detail','detail.package'])
                            ->whereBetween('date',[$req->date_start,$req->date_end])
                            ->orderBy('invoice','DESC')
                            ->get();
            
            $total  = Transaction::sum('total');
        }else{
            $report = Transaction::with(['member','outlet','detail','detail.package'])
                            ->where('outlet_id', $req->outlet_id)
                            ->whereBetween('date',[$req->date_start,$req->date_end])
                            ->get();
            $total  = Transaction::where('outlet_id', $req->outlet_id)
                            ->sum('total');
        }
        
         $pdf   = PDF::loadview('laporan.print', compact('report','date_start','date_end','total'));
        return $pdf->stream();
    }

    


}
