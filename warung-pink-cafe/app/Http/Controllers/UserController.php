<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Orderdetail;
use Darryldecode\Cart\Cart;
use App\Models\Menucategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return view('welcome',[
            'menu' => Menu::all()
        ]);
    }

    public function category(Request $request){
        if($request->kategori == null || $request->kategori == ""){
            return redirect()->route('home')->with('error','Pilih Dengan Benar !');
        }
        return view('category',[
            'menu' => Menucategory::with('menu')->where('kategori',$request->kategori)->get(),
            'sandingan' => Menucategory::with('menu')->where('kategori','Sandingan '.$request->kategori)->get(),
        ]);
    }

    public function cart(){

        $user = session()->getId();
        return view('cart',[
            'cart' => \Cart::session($user)->getContent()
        ]);
    }

    public function confirm(){
        $user = session()->getId();
        $cart = \Cart::session($user)->getContent();
        if($cart->isEmpty()){
            return redirect()->back()->with('error',"Cart Kosong");
        }
        return view('confirm',[
            'cart' => $cart
        ]);
    }

    public function finish(){
        return view('finish');
    }

    public function addCart(Request $request){
        $validator = Validator::make($request->all(),[
            'menu_id' => 'required',
            'jumlah' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }
        $user = session()->getId();
        $cartcheck = \Cart::session($user)->get($request->menu_id);
        if($cartcheck){
            return redirect()->back()->with('success',"Item Sudah Ada");
        }

        $menusearch = Menu::where('id',$request->menu_id)->first();

        $user = session()->getId();
        $cart = \Cart::session($user)->add(array(
            'id' => $menusearch->id,
            'name' => $menusearch->nama,
            'price' => $menusearch->harga,
            'quantity' => $request->jumlah,
            'attributes' => array(
                'catatan' => '',
                'gambar' => $menusearch->gambar
            )
        ));

        return redirect()->back()->with('success','Berhasil Menambahkan Cart');
    }

    public function editcatatan(Request $request){
        $validator = Validator::make($request->all(),[
            'menu_id' => 'required',
            'catatan' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $user = session()->getId();
        $cartcheck = \Cart::session($user)->get($request->menu_id);
        if($cartcheck->isEmpty()){
            return redirect()->back()->with('error',"Cart Tidak Ditemukan");
        }

        $cart = \Cart::session($user)->update($request->menu_id,array(
            'attributes' => array(
                'catatan' => $request->catatan
            ),
        ));

        return redirect()->back()->with('success','Berhasil Mengupdate Cart');
    }
    public function editqty(Request $request){
        $validator = Validator::make($request->all(),[
            'menu_id' => 'required',
            'jumlah' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $user = session()->getId();
        $cartcheck = \Cart::session($user)->get($request->menu_id);
        if($cartcheck->isEmpty()){
            return redirect()->back()->with('error',"Cart Tidak Ditemukan");
        }
        if($cartcheck->quantity == 1 && $request->jumlah == '-1'){
            \Cart::session($user)->remove($request->menu_id);
            return redirect()->back()->with('success','Berhasil Mengupdate Cart');
        }
        $cart = \Cart::session($user)->update($request->menu_id,array(
            'quantity' => $request->jumlah,
        ));

        return redirect()->back()->with('success','Berhasil Mengupdate Cart');
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(),[
            'search' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $menu2 = Menu::where('nama','like','%'.$request->search.'%')->get();
        $menu = Menucategory::with('menu')->where('kategori','like','%'.$request->search.'%')->get();
        foreach ($menu as $menu){
            $menu2->push($menu->menu);
        }
        return view('category',[
            'menu' => $menu2->unique()
        ]);
    }

    public function transaksi(Request $request){
        $validator = Validator::make($request->all(),[
            'metode' => 'required',
            'meja' => "required"
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $user = session()->getId();
        $cart = \Cart::session($user)->getContent();

        $order = Order::create([
            'status' => 'Process',
            'meja' => $request->meja,
            'jenis_pembayaran' => $request->metode,
            'total' => $request->total,
        ]);

        foreach($cart as $cart){
            Orderdetail::create([
                'order_id' => $order->id,
                'menu_id' => $cart->id,
                'catatan' => $cart->attributes->catatan,
                'jumlah' => $cart->quantity,
            ]);
        }

        \Cart::session($user)->clear();

        return redirect()->route('transaksi.result',$order->id)->with('success','Berhasil Melakukan Transaksi');
    }

    public function transaksiresult(Request $request, Order $order){
        return view('finish',[
            'order' => $order
        ]);
    }
}
