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
            <h3>Data Rombel</h3>
            <p>Home / Data Rombel</p>
        </div>

            <div class="container bg-white" style="height:850px;">


            <div class="button"
            style="
            width:800px;
            display:flex;
            margin-top:50px;
            margin-left:20px;
            justify-content:space-between;
            ">


                <form action="{{ route('rombels.search') }}" method="GET">
                    <div class="input-group flex-nowrap">
                    <input type="text" name="query" class="form-control" placeholder="Cari Rombel" >
                    <button type="submit" class="btn btn-info text-white">Search</button>
                </div>
                </form>

                <form action="{{ route('rombels.create') }}">
                <button style="
                    width:100px;
                    margin-left:85%;
                    margin-right:20px;
                    " type="submit" class="btn btn-success">Tambah</button>
                </form>


            </div>


            @if(!isset($query))
            <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Rombel</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($rombels as $item)
                    <tr>
                    <td>{{ $no++}}.</td>
                    <td>{{ $item['rombels'] }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('rombels.edit', $item['id']) }}" method="">
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('rombels.delete', $item['id']) }}" method="post">
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
              <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Rombel</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($rombelSearch as $item)
                    <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rombels'] }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('rombels.edit', $item['id']) }}" method="post">
                                <button type="button" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('rombels.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-info text-white m-2" style="background: purple">Delete</button>
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
