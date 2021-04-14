<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('created_at','DESC')->paginate(5);
        return view('members.index', compact('members'));
    }

    public function save(Request $req)
    {
        $this->validate($req,[
            'name'    => 'required|string|max:100',
            'address' => 'required|string',
            'gender'  => 'required|string',
            'phone'   => 'required|max:15'
        ]);

        try {
            $member   = Member::updateOrCreate([
            'name'    => $req->name,
            'address' => $req->address,
            'gender'  => $req->gender,
            'phone'   => $req->phone    
            ]);
        
            return back()->with('success','Berhasil menambah data');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

    }

    public function delete($id)
    {
        $member = Member::find($id);
        $member->delete();
        return back()->with('success','Berhasil menghapus data');
    }

    public function edit($id)
    {
        $members = Member::findOrFail($id);
        return view('members.edit', compact('members'));
    }

    public function update(Request $req, $id)   
    {
        $this->validate($req,[
            'name'    => 'required|string|max:100',
            'address' => 'required|string',
            'gender'  => 'required|string',
            'phone'   => 'required|max:15'
        ]);
        try {
            $member = Member::find($id);
            $member->update([
            'name'    => $req->name,
            'address' => $req->address,
            'gender'  => $req->gender,
            'phone'   => $req->phone    
            ]);
            return redirect('member')->with('success','Data berhasil diedit');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
}
