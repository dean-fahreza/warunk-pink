<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menucategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menuindex',[
            'menu' => Menu::all()
        ]);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $img = $request->file('gambar');
        $imgName = $img->hashName();
        $img->storeAs('public/photo/',$imgName);

        $menu = Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imgName,
            'harga' => $request->harga
        ]);

        for($i = 0; $i < sizeof($request->kategori); $i++){
            Menucategory::create([
                'menu_id' => $menu->id,
                'kategori' => $request->kategori[$i]
            ]);
        }

        return redirect()->back()->with('success','Berhasil Menambahkan Menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'menu_id' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->first());
        }

        $menu = Menu::where('id' , $request->menu_id)->first();

        if(empty($menu)){
            return redirect()->back()->with('error', 'Tidak Ada Menu');
        }

        if($request->file('gambar')){
            Storage::disk('public')->delete('photo/'.$menu->gambar);
            $img = $request->file('gambar');
            $imgName = $img->hashName();
            $img->storeAs('public/photo/',$imgName);

            $menu->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar' => $imgName,
                'harga' => $request->harga
            ]);

            $menudetail = Menucategory::where('menu_id',$menu->id)->get();
            foreach($menudetail as $detail){
                $detail->delete();
            }

            for($i = 0; $i < sizeof($request->kategori); $i++){
                Menucategory::create([
                    'menu_id' => $menu->id,
                    'kategori' => $request->kategori[$i]
                ]);
            }
        }else{
            $menu->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga
            ]);

            $menudetail = Menucategory::where('menu_id',$menu->id)->get();
            foreach($menudetail as $detail){
                $detail->delete();
            }

            for($i = 0; $i < sizeof($request->kategori); $i++){
                Menucategory::create([
                    'menu_id' => $menu->id,
                    'kategori' => $request->kategori[$i]
                ]);
            }
        }

        return redirect()->route('daftarmenu')->with('success','Berhasil Mengupdate Menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
