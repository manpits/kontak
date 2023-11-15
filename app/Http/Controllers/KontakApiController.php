<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kontak::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kontak = new Kontak();
        $kontak->fill($request->all())->save();
        return $kontak;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Kontak::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kontak = Kontak::find($id);
        $kontak->fill($request->all())->save();
        return $kontak;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kontak = Kontak::find($id);
        $kontak->delete();
    }
}
