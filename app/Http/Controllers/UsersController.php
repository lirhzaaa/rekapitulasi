<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;





class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' =>  'required|email:dns',
            'password' => 'required'
        ]);

        $users = $request->only(['email', 'password']);
        if (Auth::attempt($users)) {
            return redirect()->route('dashboard.home');
        } else {
            return redirect()->back()->with('failed', 'Proses login gagal silahkan coba kembali dengan data yang benar ! ');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda Telah Logout !!');
    }


    public function index()
    {
        $users = users::all();
        $id = 0;
            // Mengambil data spesifik berdasarkan ID
            $specificData = users::find($id);

            // Mengambil data lainnya (opsional)
            $userOtherData = users::where('id', '!=', $id)->get();

        return view('users.index', compact('userOtherData'));
    }



    public function search(Request $request){
        $query = $request->input('query');

        $idCheck = 0;
            // Mengambil data spesifik berdasarkan ID
            $specificData = users::find($idCheck);

            // Mengambil data lainnya (opsional)
            $userOtherData = users::where('id', '!=', $idCheck)->get();
        $request->session()->put('search_query', $query);
        $userSearch = users::where('nama', 'LIKE', "%$query%")
                            ->orWhere('email', 'LIKE', "%$query%")
                            ->orWhere('role', 'LIKE', "%$query%")
                            ->get();
        return view('users.index', compact('userSearch', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $nama = $request->input('nama');
        $gmail = $request->input('email');

        $password = $this->generatePassword($nama, $gmail);

        Users::create([
            'nama' => $nama,
            'email' => $gmail,
            'role' => $request->role,
            'password' => bcrypt($password)
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }
    public function generatePassword($name, $email)
    {
        // Ambil 3 karakter pertama dari nama
        $namePart = Str::substr($name, 0, 3);

        // Ambil 3 karakter pertama dari alamat email (gmail)
        $emailPart = Str::substr(explode('@', $email)[0], 0, 3);

        // Gabungkan kedua bagian untuk membentuk password
        $password = $namePart . $emailPart;

        return $password;
    }

    /**
     * Display the specified resource.
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = users::find($id);
        return view('users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        Users::where('id', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' =>  bcrypt($request->password) ,
            'role' => $request->role,
        ]);

        return redirect()->route('users.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        users::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');    }
}
