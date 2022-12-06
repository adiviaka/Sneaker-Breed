<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $shop = DB::select('select * from shop_owner');

        return view('shop.index')
            ->with('shop', $shop);
    }

    public function create()
    {
        $owner = DB::select('select * from owner');

        return view('shop.add')
            ->with('owner', $owner);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_shop' => 'required',
            'location_shop' => 'required',
            'id_owner' => 'required',

        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO shop( name_shop,location_shop,id_owner) VALUES (:name_shop, :location_shop, :id_owner)',
            [
                'name_shop' => $request->name_shop,
                'location_shop' => $request->location_shop,
                'id_owner' => $request->id_owner,
            ]
        );

        return redirect()->route('shop.index')->with('success', 'shop berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('shop_owner')->where('id_shop', $id)->first();
        $owner = DB::select('select * from owner');

        return view('shop.edit')->with(['data' => $data, 'owner' => $owner]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name_shop' => 'required',
            'location_shop' => 'required',
            'id_owner' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE shop SET name_shop = :name_shop, location_shop = :location_shop, id_owner = :id_owner WHERE id_shop = :id_shop',
            [
                'id_shop' => $id,
                'name_shop' => $request->name_shop,
                'location_shop' => $request->location_shop,
                'id_owner' => $request->id_owner,
            ]
        );

        return redirect()->route('shop.index')->with('success', 'Data shop berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM shop WHERE id_shop = :id_shop', ['id_shop' => $id]);

        // Menggunakan laravel eloquent
        // shop::where('id_shop', $id)->delete();

        return redirect()->route('shop.index')->with('success', 'Data shop berhasil dihapus');
    }
}
