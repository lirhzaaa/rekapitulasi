@extends('layouts.template')
@section('content')
    @if (Session::get('success'))
        <div class="alert">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert">{{ Session::get('deleted') }}</div>
    @endif

    <div class="container bg-white" style="height: 850px">


        <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Siswa</h3>
            <p>Home / Data Siswa</p>
        </div>


        <div class="button"
            style="
            width:800px;
            display:flex;
            margin-top:50px;
            margin-left:20px;
            justify-content:space-between;
            ">


            <form action="{{ route('students.search') }}" method="GET">
                <div class="input-group flex-nowrap">
                    <input type="text" name="query" class="form-control" placeholder="Cari Siswa">
                    <button type="submit" class="btn btn-info text-white">Search</button>
                </div>
            </form>

            <form action="{{ route('students.create') }}">
                <button
                    style="
                    width:100px;
                    margin-left:85%;
                    margin-right:20px;
                    "
                    type="submit" class="btn btn-success">Tambah</button>
            </form>


        </div>



        @if (!isset($query))
            <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                        <th class="text-purple">No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Rombel</th>
                        <th>Rayon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($students as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item['nis'] }}</td>
                            <td>{{ $item['nama'] }}</td>
                            @php $isUserDisplayed = false; @endphp
                            @foreach ($rombels as $rombel)
                                @if ($rombel['rombel']['id'] == $item['rombel_id'])
                                    @if (!$isUserDisplayed)
                                        <td>{{ $rombel['rombel']['rombels'] }}</td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                            @endforeach
                            @php $test = false; @endphp
                            @foreach ($rayons as $rayon)
                                @if ($rayon['rayon']['id'] == $item['rayon_id'])
                                    @if (!$test)
                                    <td>{{ $rayon['rayon']['rayons'] }}</td>
                                    @php $test = true; @endphp
                                    @endif
                                @endif
                            @endforeach
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('students.edit', $item['id']) }}" method="">
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple;">Edit</button>
                                    </form>
                                    <form action="{{ route('students.delete', $item['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple">Hapus</button>
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
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Rombel</th>
                        <th>Rayon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($studentSearch as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item['nis'] }}</td>
                            <td>{{ $item['nama'] }}</td>
                            @foreach ($rombels as $rombel)
                                @if ($rombel['id'] == $item['rombel_id'])
                                    <td>{{ $rombel['rombels'] }}</td>
                                @endif
                            @endforeach
                            @foreach ($rayons as $rayon)
                                @if ($rayon['id'] == $item['rayon_id'])
                                    <td>{{ $rayon['rayons'] }}</td>
                                @endif
                            @endforeach
                            <td>
                                <form action="" method="post"></form>
                                <a href="{{ route('students.edit', $item['id']) }}">Edit</a>
                                <form action="{{ route('students.delete', $item['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    @endif

@endsection
