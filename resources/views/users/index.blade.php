@extends('layouts.template')
@section('content')
@if (Session::get('success'))
    <div class="alert">{{ Session::get('success') }}</div>
@endif
@if (Session::get('deleted'))
    <div class="alert">{{ Session::get('deleted') }}</div>
@endif
<div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Pengguna</h3>
            <p>Home/ Data Pengguna</p>
        </div>

         <div class="button"
            style="
            width:800px;
            display:flex;
            margin-top:50px;
            margin-left:20px;
            justify-content:space-between;
            ">


                <form action="{{ route('users.search') }}" method="GET">
                    <div class="input-group flex-nowrap">
                    <input type="text" name="query" class="form-control" placeholder="Cari Pengguna" >
                    <button type="submit" class="btn btn-info text-white">Search</button>
                </div>
                </form>

                <form action="{{ route('users.create') }}">
                <button style="
                    width:100px;
                    margin-left:85%;
                    margin-right:20px;
                    " type="submit" class="btn btn-success">Tambah</button>
                </form>


            </div>
                    <div class="container bg-white" style="height: 850px">
    @if(!isset($query))
            <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($userOtherData as $item)
                    <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                   <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('users.edit', $item['id']) }}" method="">
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('users.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple">Hapus</button>
                            </form>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    @else
            <p style="margin: 20px;">Search results for: <strong>{{ $query }}</strong></p>
            <table class="table" style="margin-top: 50px; text-agn:center;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($userSearch as $item)
                    <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('users.edit', $item['id']) }}" method="">
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('users.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple">Hapus</button>
                            </form>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    @endif

                    </div>
@endsection
