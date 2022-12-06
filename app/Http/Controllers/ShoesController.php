<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $shoes = DB::select('select * from shoes_shop where (shoes_type LIKE "%' . $request->search . '%")' . 'AND deleted_at is null');
            $shoes_deleted =
                DB::table('shoes')->whereNotNull('deleted_at')->get();

            return view('shoes.index', [
                'shoes' => $shoes,
                'shoes_deleted' => $shoes_deleted,
            ]);
        } else {
            $shoes = DB::table('shoes')->whereNull('deleted_at')->get();

            $shoes_deleted =
                DB::table('shoes')->whereNotNull('deleted_at')->get();


            return view('shoes.index', [
                'shoes' => $shoes,
                'shoes_deleted' => $shoes_deleted,
            ]);
        }
    }

    public function create()
    {
        $shop = DB::select('select * from shop');

        return view('shoes.add')
            ->with('shop', $shop);
    }


    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required',
            'brand' => 'required',
            'shoes_type' => 'required',
            'color' => 'required',
            'price' => 'required',
            'id_shop' => 'required',
            'delete_at' => '',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO shoes( gambar,brand,shoes_type, color,price,id_shop) VALUES (:gambar, :brand, :shoes_type, :color,:price,:id_shop)',
            [
                'gambar' => $request->gambar,
                'brand' => $request->brand,
                'shoes_type' => $request->shoes_type,
                'color' => $request->color,
                'price' => $request->price,
                'id_shop' => $request->id_shop,
                // 'delete_at' => $request->delete_at,
            ]
        );

        return redirect()->route('shoes.index')->with('success', 'Shoes berhasil disimpan');
    }

    public function edit($id)
    {
        $shoes = DB::table('shoes_shop')->where('id_shoes', $id)->first();
        $shop = DB::select('select * from shop');

        return view('shoes.edit')->with(['shoes' => $shoes, 'shop' => $shop]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'gambar' => 'required',
            'brand' => 'required',
            'shoes_type' => 'required',
            'color' => 'required',
            'price' => 'required',
            'id_shop' => 'required',
            // 'delete_at' => '',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE shoes SET gambar = :gambar, brand = :brand, shoes_type = :shoes_type, color = :color, price = :price, id_shop = :id_shop WHERE id_shoes = :id_shoes',
            [
                'id_shoes' => $id,
                'gambar' => $request->gambar,
                'brand' => $request->brand,
                'shoes_type' => $request->shoes_type,
                'color' => $request->color,
                'price' => $request->price,
                'id_shop' => $request->id_shop,
                // 'delete_at' => $request->delete_at,
            ]
        );

        return redirect()->route('shoes.index')->with('success', 'Data Shoes berhasil diubah');
    }

    public function destroy($id)
    {

        DB::table('shoes')
            ->where('id_shoes', $id)
            ->update(['deleted_at' => Carbon::now()]);
        return redirect()->route('shoes.index')->with('success', 'Data shoes berhasil Dihapus');
    }

    public function restore($id)
    {
        DB::update("update shoes set deleted_at = :deleted_at where id_shoes = :id_shoes", [
            'deleted_at' => null,
            'id_shoes' => $id
        ]);
        return redirect()->back()->with('success', 'Data shoes berhasil direstore');
    }

    public function forceDelete($id)
    {
        // DB::select('select * from shoes_bus where deleted_at!=NULL');
        DB::delete('DELETE FROM shoes WHERE id_shoes = :id_shoes', ['id_shoes' => $id]);

        // shoes::where('id_shoes', $id)->withTrashed()->forceDelete();
        return redirect()->back()->with('success', 'Data shoes berhasil dihapus permanent');
    }
}
