<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rayons;
use App\Models\rombels;
use App\Models\students;
use App\Models\lates;
use App\Models\users;
use Illuminate\Support\Facades\Auth;

class TampilData extends Controller
{

    public function index()
    {
        // Mengambil data dari Database Pertama
        $data_rayons = rayons::all();
        $jumlah_data_rayons = $data_rayons->count();

        // Mengambil data dari Database Kedua
        $data_rombels = rombels::all();
        $jumlah_data_rombels = $data_rombels->count();

        // Mengambil data dari Database Ketiga
        $data_students = students::all();
        $jumlah_data_students = $data_students->count();

        $data_users = users::all();
        // Menghitung jumlah data berdasarkan tipe 'admin'
    $jumlah_data_users1 = 0;

    // Menghitung jumlah data berdasarkan tipe 'ps'
    $jumlah_data_users2 = 0;

    foreach ($data_users as $user) {
        if ($user['type'] === 'admin') {
            $jumlah_data_users1++;
        } elseif ($user['type'] === 'ps') {
            $jumlah_data_users2++;
        }
    }

    $users = Auth::id();
    $students = students::all();
    $rayons = rayons::all();
    $latests = lates::all();






        // Pass data ke view
        return view('dashboard', compact('latests','users', 'students','rayons','jumlah_data_rayons', 'jumlah_data_rombels', 'jumlah_data_students', 'jumlah_data_users1', 'jumlah_data_users2', 'data_users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function tampilCreate()
    {
        $rayons = rayons::all();
        $rombels = rombels::all();

        return view('dataMaster.', compact('rayons', 'rombels'));
    }

    public function tampilDataPs($id){
        $users = users::all();
        return view('rayons.home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
