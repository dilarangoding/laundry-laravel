<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::orderBy('created_at','DESC')->paginate(5);
        return view('outlets.index',\compact('outlets'));
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'name'  =>'required|string|max:100',
            'address'=>'required',
            'phone' =>'required|max:15'
        ]);

        try {
            $outlets = Outlet::firstOrCreate([
             'name'  =>$req->name,
             'address'=>$req->address,
             'phone' =>$req->phone
            ]);
            return \redirect()->back()->with('success','Berhasil menambah data');
        } catch (\Throwable $th) {
            return \back()->with('error',$th->getMessage());
        }
    }

    public function edit($id)
    {
        $outlet = Outlet::find($id);
        return view('outlets.edit', \compact('outlet'));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'name'  =>'string|required|max:100',
            'address'=>'string|required',
            'phone' =>'required|max:15'
        ]);

        try {
            $outlet = Outlet::findOrFail($id);
            $outlet->update([
             'name'  =>$req->name,
             'address'=>$req->address,
             'phone' =>$req->phone   
            ]);
            return redirect('outlet')->with('success','Berhasil mengedit data');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function delete($id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        return back()->with('success','Data berhasil dihapus');
    }

}
