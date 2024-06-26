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
        <h3>Data Keterlambatan</h3>
        <p>Data Terlambat</p>
    </div>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('latests.home') }}" class="btn btn-primary  ms-2">Keseluruhan Data</a>
        <a href="{{ route('latests.rekap') }}" class="btn btn-outline-primary  ms-2">Rekapitulasi Data</a>
    </div>

    <div class="container bg-white" style="height: 850px">
        <div class="button"
            style="
            width:900px;
            display:flex;
            margin-top:50px;
            margin-left:20px;
            justify-content:space-between;
            ">


            <form action="{{ route('latests.search') }}" method="GET">
                <div class="input-group flex-nowrap">
                    <input type="text" name="query" class="form-control" placeholder="Cari Detail Keterlambatan">
                    <button type="submit" class="btn btn-info text-white">Search</button>
                </div>
            </form>
            <div class="btn" style="display: flex; justify-content:space-around">
                <form action="{{ route('export.excel') }}" style="
                    width:150px;
                    margin-left:20%;
                    ">
                    <button type="submit" class="btn btn-danger text-white">Export</button>
                </form>
                <form action="{{ route('latests.create') }}">
                    <button style="
                    width:100px;
                    " type="submit"
                        class="btn btn-info text-white">Tambah</button>
                </form>
            </div>


        </div>

        @if (!isset($searchQuery))
            <table class="table" style="margin-top: 50px; text-align:start;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Terlambat</th>
                        <th>Informasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($latests as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            @php $isUserDisplayed = false; @endphp
                            @foreach ($students as $student)
                                @if ($student['student']['id'] == $item['student_id'])
                                    @if (!$isUserDisplayed)
                                        <td>
                                            {{ $student['student']['nama'] }}
                                            <em>
                                                ({{ $student['student']['nis'] }})
                                                `
                                            </em>
                                        </td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                            @endforeach
                            <td>{{ $item['date_time_late'] }}</td>
                            <td>{{ $item['information'] }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('latests.edit', $item['id']) }}" method="">
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple;">Edit</button>
                                    </form>
                                    <form action="{{ route('latests.delete', $item['id']) }}" method="post">
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
            {{-- @elseif (isset($query, $studentSearch)){
                <p style="margin: 20px;">Search results for: <strong>{{ $query }}</strong></p>
                <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Terlambat</th>
                    <th>Informasi</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($latests as $item)
                    <tr>
                    <td>{{ $no++ }}</td>
                    @php $isUserDisplayed = false; @endphp
                    @foreach ($studentSearch as $student)
                                    @if (!$isUserDisplayed)
                                    <td>
                                        {{ $student['student']['nis'] }}
                                        {{ $student['student']['nama'] }}
                                        </td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                    @endforeach
                    <td>{{ $item['date_time_late'] }}</td>
                    <td>{{ $item['information'] }}</td>
                    <td><img src="{{ asset('images/' . $item['bukti']) }}" style="width: 100px; height:auto; border-radius:10px;" alt=""></td>
                   <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('latests.edit', $item['id']) }}" method="">
                                <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                            </form>
                            <form action="{{ route('latests.delete', $item['id']) }}" method="post">
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
            } --}}
        @else
            <p style="margin: 20px;">Search results for: <strong>{{ $searchQuery }}</strong></p>
            <table class="table" style="margin-top: 50px; text-align:center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Terlambat</th>
                        <th>Informasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($latestSearch as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            @php $isUserDisplayed = false; @endphp
                            @foreach ($students as $student)
                                @if ($student['student']['id'] == $item['student_id'])
                                    @if (!$isUserDisplayed)
                                        <td>
                                            {{ $student['student']['nis'] }}
                                            {{ $student['student']['nama'] }}
                                        </td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                            @endforeach
                            <td>{{ $item['date_time_late'] }}</td>
                            <td>{{ $item['information'] }}</td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('latests.edit', $item['id']) }}" method="">
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple;">Edit</button>
                                    </form>
                                    <form action="{{ route('latests.delete', $item['id']) }}" method="post">
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
        @endif

    </div>
@endsection
