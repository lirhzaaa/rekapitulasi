<?php

namespace App\Http\Controllers;

use App\Models\rombels;
use Illuminate\Http\Request;

class RombelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombels = Rombels::all();
        return view('rombels.index', compact('rombels'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $request->session()->put('search_query', $query);
        $rombelSearch = rombels::where('rombels', 'LIKE', "%$query%")
        ->get();
        return view('rombels.index', compact('rombelSearch', 'query'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombels' => 'required'
        ]);

        Rombels::create([
            'rombels' => $request->rombels,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombels $rombels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombels = rombels::find($id);
        return view('rombels.edit', compact('rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombels' => 'required'
        ]);

        Rombels::where('id', $id)->update([
            'rombels' => $request->rombels,
        ]);

        return redirect()->route('rombels.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rombels::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
    }
}
