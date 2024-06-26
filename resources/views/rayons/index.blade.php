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
            <h3>Data Rayon</h3>
            <p>Home / Data Rayon</p>
        </div>

          <div class="button"
            style="
            width:800px;
            display:flex;
            margin-top:50px;
            margin-left:20px;
            justify-content:space-between;
            ">


                <form action="{{ route('rayons.search') }}" method="GET">
                    <div class="input-group flex-nowrap">
                    <input type="text" name="query" class="form-control" placeholder="Cari Rayon" >
                    <button type="submit" class="btn btn-info text-white">Search</button>
                </div>
                </form>

                <form action="{{ route('rayons.create') }}">
                <button style="
                    width:100px;
                    margin-left:85%;
                    margin-right:20px;
                    " type="submit" class="btn btn-success">Tambah</button>
                </form>


            </div>



            @if (!isset($query))
            <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Rayon</th>
                    <th>Pembimbing</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;

                    @endphp
                    @foreach ($rayons as $item)
                    <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rayons'] }}</td>
                    @php $isUserDisplayed = false; @endphp
                    @foreach ($rayons as $user)
                        @if ($user['user']['id'] == $item['user_id'])
                                    @if (!$isUserDisplayed)
                                    @if ($user['user']['id'] === 0)
                                    <td><em>Rayon ini tidak belum disambungkan dengan Ps</em></td>
                                    @else
                                    <td>{{ $user['user']['nama'] }}</td>
                                    @endif
                                    @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                    @endforeach
                    <td>
                         <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('rayons.edit', $item['id']) }}" method="">
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('rayons.delete', $item['id']) }}" method="post">
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
                    <th>Rayon</th>
                    <th>Pembimbing</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;

                    @endphp
                    @foreach ($rayonSearch as $item)
                    <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rayons'] }}</td>
                    @php $isUserDisplayed = false; @endphp
                    @foreach ($users as $user)
                        @if ($user['user']['id'] == $item['user_id'])
                                    @if (!$isUserDisplayed)
                                        <td>{{ $user['user']['nama'] }}</td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                    @endforeach
                    <td>
                         <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('rayons.edit', $item['id']) }}" method="">
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('rayons.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-info text-white m-2" style="background: purple">Hapus</button>
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

