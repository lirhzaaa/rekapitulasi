@extends('layouts.template')
@section('content')
  <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Pengguna</h3>
            <p>Home / Data Pengguna / Update Data</p>
        </div>

                    <div class="container bg-white" style="height:850px;">

        <div class="card bg-white border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">

<form action="{{ route('users.update' , $users['id']) }}" method="post">
    @csrf
    @method('PATCH')
    @if (Session::get('success'))
    <div class="alert">{{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
    <ul>
        <li>@foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach</li>
    </ul>
    @endif
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="text" class="form-control mt-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" value="{{ $users['nama'] }}">

            <label for="exampleInputEmail1" class="form-label mt-3">Email</label>
            <input type="email" class="form-control mt-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ $users['email'] }}">

            <label for="password" class="form-label mt-3">Password</label>
            <input type="password" class="form-control mt-3" id="password" aria-describedby="emailHelp" name="password">

            <label for="user_id" class="mt-3">Role</label>
            <select class="form-select mt-3" aria-label="Default select example" name="role">
            <option value="{{ $users['role'] }}">{{ $users['role'] }}</option>
            @if ($users['role'] === 'admin')
            <option value="Ps">Ps</option>
            @elseif ($users['role'] === 'ps')
            <option value="admin">Admin</option>
            @endif
            </select>
        <button type="submit" class="btn btn-primary mt-5">Tambah</button>
</form>
        </div>
        </div>
    </div>
@endsection
