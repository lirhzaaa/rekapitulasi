<?php

namespace App\Http\Controllers;

use App\Models\rayons;
use App\Models\users;
use Illuminate\Http\Request;

class RayonsController extends Controller
{
    public function index()
    {
        $users = rayons::with('user')->simplePaginate(10);
        $rayons = rayons::all();
        return view('rayons.index', compact('rayons', 'users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = rayons::with('user')->simplePaginate(10);
        $request->session()->put('search_query', $query);
        $rayonSearch = rayons::whereHas('user', function ($userQuery) use ($query) {
        $userQuery->where('nama', 'like', '%' . $query . '%');
    })
        ->orWhere('rayons', 'LIKE', "$query")
        ->orWhere('user_id', 'LIKE', "%$query%")
        ->get();
        return view('rayons.index', compact('rayonSearch', 'query', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $users = users::all();
            $id = 0;
            // Mengambil data spesifik berdasarkan ID
            $specificData = users::find($id);

            // Mengambil data lainnya (opsional)
            $userOtherData = users::where('id', '!=', $id)->get();
            return view('rayons.create', compact('userOtherData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayons' => 'required',
            'user_id' => 'required'
        ]);

        rayons::create([
            'rayons' => $request->rayons,
            'user_id' => $request->user_id
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayons $rayons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
            $idCheck = 0;
            // Mengambil data spesifik berdasarkan ID
            $specificData = users::find($idCheck);

            // Mengambil data lainnya (opsional)
            $userOtherData = users::where('id', '!=', $idCheck)->get();
            $rayons = rayons::find($id);
        return view('rayons.edit', compact('rayons', 'userOtherData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayons' => 'required',
            'user_id' => 'required'
        ]);

        rayons::where('id', $id)->update([
            'rayons' => $request->rayons,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('rayons.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        rayons::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil  menghapus data');
    }
}
