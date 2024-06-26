@extends('layouts.template')
@section('content')
    <div class="container bg-white" style="height: 850px">

        <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Rekap</h3>
            <p>Rekapitulasi Data / Detail</p>
        </div>

        <div class="text_ket"
            style="
            display:flex;
            margin-top:50px;
            margin-left:20px;
            font-size:25px;
            ">
                    <b>
                        <p>{{ $students['nama'] }}</p>
                    </b>
                    <p>&nbsp;| &nbsp; </p>
                    <p>{{ $students['nis'] }}</p>
                    <p> &nbsp;| &nbsp; </p>
                    @foreach ($rombels as $rombel)
                        @if ($rombel['id'] == $students['rombel_id'])
                            <p>{{ $rombel['rombels'] }}</p>
                            <p> &nbsp;| &nbsp; </p>
                        @endif
                    @endforeach
                    @foreach ($rayons as $rayon)
                        @if ($rayon['id'] == $students['rayon_id'])
                            <p>{{ $rayon['rayons'] }}</p>
                            <p></p>
                        @endif
                    @endforeach
        </div>
        <div class="container" style="width: auto; display:flex; flex-wrap:wrap; margin">
            @php
                $no = 1;
            @endphp
            @foreach ($latests as $item)
                @if ($item['student_id'] == $students['id'])
                    <div class="card" style="width: 250px;  margin:20px 30px;">
                        <div class="card-body">
                            <h5 class="card-title">Keterlambatan ke -
                                {{ $no++ }}</h5>
                            <p class="card-text">{{ $item['information'] }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $item['date_time_late'] }}</small>
                            </p>
                        </div>
                        <img src="{{ asset('images/' . $item['bukti']) }}" class="card-img-bottom" alt="...">
                    </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection
