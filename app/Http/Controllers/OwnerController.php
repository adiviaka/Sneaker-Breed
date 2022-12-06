<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function index()
    {
        $owner = DB::select('select * from owner');

        return view('owner.index')
            ->with('owner', $owner);
    }

    public function create()
    {
        $owner = DB::select('select * from owner');

        return view('owner.add')
            ->with('owner', $owner);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_owner' => 'required',
            'telp' => 'required',
            'email' => 'required',

        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO `owner` (name_owner,telp,email) VALUES (:name_owner, :telp, :email)',
            [
                'name_owner' => $request->name_owner,
                'telp' => $request->telp,
                'email' => $request->email,
            ]
        );

        return redirect()->route('owner.index')->with('success', 'owner berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('owner')->where('id_owner', $id)->first();

        return view('owner.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name_owner' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE `owner` SET name_owner = :name_owner, telp = :telp, email = :email WHERE id_owner = :id_owner',
            [
                'id_owner' => $id,
                'name_owner' => $request->name_owner,
                'telp' => $request->telp,
                'email' => $request->email,
            ]
        );

        return redirect()->route('owner.index')->with('success', 'Data owner berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM `owner` WHERE id_owner = :id_owner', ['id_owner' => $id]);

        return redirect()->route('owner.index')->with('success', 'Data owner berhasil dihapus');
    }
}
