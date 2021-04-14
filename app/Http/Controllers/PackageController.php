<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Package;
use App\Outlet;

class PackageController extends Controller
{
    public function index()
    {
      $packages = Package::with(['outlet'])->orderBy('created_at','DESC')->paginate(4);
      $outlets = Outlet::all();
      return view('packages.index', compact('packages','outlets'));
    }

    public function store(Request $req)
    {
      $this->validate($req,[
          'outlet_id'=>'required',
          'type'     =>'required',
          'name'     =>'required|string|max:100',
          'price'    =>'required'
      ]);
      
      try {
      $package = Package::updateOrCreate([
          'outlet_id'=>$req->outlet_id,
          'type'=>$req->type,
          'name'=>$req->name,
          'price'=>$req->price,
      ]);

        return back()->with('success','Berhasil menambah data paket');
      } catch (\Throwable $th) {
        return back()->with('error',$th->getMessage());
      }

    }

    public function edit($id)
    {
      $packages = Package::findOrFail($id);
      $outlets = Outlet::all();
      return view('packages.edit', compact('packages','outlets'));
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
          'outlet_id'=>'required',
          'type'     =>'required',
          'name'     =>'required|string|max:100',
          'price'    =>'required'
      ]);
      
      try {
      $package = Package::findOrFail($id);
      $package->update([
          'outlet_id'=>$req->outlet_id,
          'type'=>$req->type,
          'name'=>$req->name,
          'price'=>$req->price,
      ]);

        return redirect('package')->with('success','Berhasil mengedit data paket');
      } catch (\Throwable $th) {
        return back()->with('error',$th->getMessage());
      }
    }

    public function delete($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return back()->with('success','Data berhasil dihapus');
    }



}
