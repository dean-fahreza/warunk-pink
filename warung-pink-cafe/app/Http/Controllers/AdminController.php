<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard',[
            'order' => Order::all(),
        ]);
    }

    public function history(){
        return view('admin.history',[
            'order' => Order::with('detail','detail.menu')->get()
        ]);
    }

    public function menu(){
        return view('admin.menu');
    }

    public function menutersedia(Request $request, Menu $menu){
        $validator = Validator::make($request->all(),[
            'tersedia' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $menu->update([
            'tersedia' => $request->tersedia
        ]);

        return redirect()->route('daftarmenu')->with('success','Berhasil Mengupdate Menu');
    }
}
