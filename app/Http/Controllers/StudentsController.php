<?php

namespace App\Http\Controllers;

use App\Models\rombels;
use App\Models\rayons;
use App\Models\students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = students::all();
        $rombels = students::with('rombel')->simplePaginate(10);
        $rayons = students::with('rayon')->simplePaginate(10);
        return view('students.index', compact('students', 'rombels', 'rayons'));

    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $students = students::all();
        $rombels = rombels::all();
        $rayons = rayons::all();
        $request->session()->put('search_query', $query);
        $studentSearch = students::where('nama', 'LIKE', "%$query%")
        ->orWhere('nis', 'LIKE', "%$query%")
        ->orWhere('rombel_id', 'LIKE', "%$query%")
        ->orWhere('rayon_id', 'LIKE', "%$query%")
        ->get();
        return view('students.index', compact('studentSearch', 'query', 'rombels', 'rayons', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $rombels = rombels::all();
        $rayons = rayons::all();
        return view('students.create', compact('rombels', 'rayons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        $rombel = $request->rombel_id;
        $rayon = $request->rayon_id;
        Students::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'rombel_id' => $rombel,
            'rayon_id' => $rayon,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombels = rombels::all();
        $rayons = rayons::all();
        $students = students::find($id);
        return view('students.edit', compact('rombels', 'students', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required'
        ]);

        students::where('id', $id)->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id
        ]);

        return redirect()->route('students.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        students::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');    }
}
