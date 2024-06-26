@extends('layouts.template')
@section('content')
    @if (Auth::user()->role == 'admin')
        @php

            $admin = 0;
            $ps = 0;

            foreach ($data_users as $user) {
                if ($user['role'] === 'admin') {
                    $admin++;
                } elseif ($user['role'] === 'ps') {
                    $ps++;
                }
            }
        @endphp
        <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Dashboard</h3>
            <p>Home / Dashboard</p>
        </div>

        <div class="row m-2">

            <div class="col">
                <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <p>Peserta Didik:</p>
                    <div class="student"
                        style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                        <i style="font-size: 50px" class="bi bi-person"></i>
                        <h3 style="margin-top:20px;" class=""> {{ $jumlah_data_students }}</h3>
                    </div>

                </div>
            </div>

            <div class="col col-lg-3">
                <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <p>Administrator:</p>
                    <div class="student"
                        style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                        <i style="font-size: 50px" class="bi bi-person"></i>
                        <h3 style="margin-top:20px;" class=""> {{ $admin }}</h3>
                    </div>

                </div>
            </div>

            <div class="col col-lg-4">
                <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <p>Pembimbing Siswa:</p>
                    <div class="student"
                        style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                        <i style="font-size: 50px" class="bi bi-person"></i>
                        <h3 style="margin-top:20px;" class=""> {{ $ps }}</h3>
                    </div>

                </div>
            </div>

        </div>

        <div class="row m-2">
            <div class="col">
                <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <p>Rombel:</p>
                    <div class="student"
                        style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                        <i style="font-size: 40px" class="bi bi-bookmarks-fill"></i>
                        <h3 style="margin-top:20px;" class=""> {{ $jumlah_data_rombels }}</h3>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <p>Rayon:</p>
                    <div class="student"
                        style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                        <i style="font-size: 40px" class="bi bi-bookmarks-fill"></i>
                        <h3 style="margin-top:20px;" class=""> {{ $jumlah_data_rayons }}</h3>
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="container bg-white" style="height:850px;">
            <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
                <h3>Dashboard</h3>
                <p>Home / Dashboard</p>
            </div>
            <div class="row m-2">
                <div class="col">
                    <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                        @foreach ($rayons as $key)
                            <p>Jumlah Peserta Didik {{ $key['rayons'] }}:</p>
                            <div class="student"
                                style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                                <i style="font-size: 50px" class="bi bi-person"></i>
                                @php
                                    $count = 0;
                                @endphp
                                @if ($key['user_id'] == Auth::id())
                                    @foreach ($students as $std)
                                        @if ($std['rayon_id'] == $key['id'])
                                            @php
                                                $count++;
                                            @endphp
                                        @else
                                            @php
                                                $count = 0;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                        @endforeach
                        <h3 style="margin-top: 20px">{{ $count }}</h3>
                        </>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                    <p>Jumlah Keterlambatan:</p>
                    <div class="student"
                        style="
                        display:flex;
                        margin-left:-30px;
                        justify-content:space-evenly;
                        width:150px;
                        ">

                        <i style="font-size: 50px" class="bi bi-person"></i>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($rayons as $key)
                            @if ($key['user_id'] == Auth::id())
                                @foreach ($students as $std)
                                    @if ($std['rayon_id'] == $key['id'])
                                        @foreach ($latests as $lates)
                                            @if ($lates['student_id'] == $std['id'])
                                                @php
                                                    $count++;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        <h3 style="margin-top: 20px">{{ $count }}</h3>
                        </>
                    </div>

                </div>
            </div>
        </div>
        </div>
    @endif
@endsection
