<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekam Keterlambatan</title>
    <link rel="stylesheet" href="{{ asset('public.custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    * {
        /* font-family: Verdana, Geneva, Tahoma, sans-serif ; */
        color: purple;
    }

    .container {
        margin: 0;
        padding: 0;
    }

    #sidebar {
        margin-bottom: 20px;
        background: white;
    }

    a {
        text-decoration: none;
        color: black
    }

    #list {
        list-style: none;
        margin-right: 20px;
        margin-top: 30px;
        letter-spacing: 0.2px;
        font-size: 17px;
        font-style: inherit;
    }

    li {

        margin: 10px;
    }

    i {
        width: 20px;
        margin-right: 5px;
    }

    .content {
        position: absolute;
    }

    .navbar-brand {
        text-align: start;
        margin-left: 50px;
        color: purple;
        font-size: 25px;
        letter-spacing: 0.5px;
    }
</style>

<body>
    @if (Auth::user()->role == 'admin')
        <nav class="navbar shadow  bg-body-tertiary rounded">
            <a class="navbar-brand" href="{{ route('dashboard.home') }}"><b>Rekap Keterlambatan</b></a>
            <div class="dropdown">
                <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    style="margin-right: 50px">
                    {{ Auth::user()->role }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="">
            <div class="row">
                {{-- sidebar --}}
                <div class="col col-lg-3">
                    <div class=" border border-0 shadow bg-body-tertiary rounded"
                        style="margin-top:10px;width:310px; height:100%;" id="sidebar">
                        <ul id="list">
                            <li>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <a href="{{ route('dashboard.home') }}">Dashboard</a>
                            </li>
                            <li>
                                <i class="bi bi-hdd-rack-fill"></i>
                                <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="margin-right: 50px">
                                    Data Master
                                </a>
                                <ul class="dropdown-menu">
                                    <li>

                                        <a href="{{ route('rombels.home') }}">Data Rombel</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('rayons.home') }}">Data Rayon</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('students.home') }}">Data Siswa</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('users.home') }}">Data Users</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <i class="bi bi-clipboard-data-fill"></i>
                                <a href="{{ route('latests.home') }}">Data Keterlambatan</a>
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- konten --}}
                <div class="col">
                    <div id="content" class="" style=" width:auto; height: 100%">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    @else
        <nav class="navbar shadow  bg-body-tertiary rounded">
            <a class="navbar-brand" href="{{ route('dashboard.home') }}"><b>Rekap Keterlambatan</b></a>
            <div class="dropdown">
                <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    style="margin-right: 50px">
                    {{ Auth::user()->role }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="row">
            {{-- sidebar --}}
            <div class="col col-lg-3">
                <div class=" border border-0 shadow bg-body-tertiary rounded"
                    style="margin-top:10px;width:310px; height:100%;" id="sidebar">
                    <ul id="list">
                        <li>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <a href="{{ route('dashboard.home') }}">Dashboard</a>
                        </li>
                        <li>
                            <i class="bi bi-hdd-rack-fill"></i>
                            <a href="{{ route('students.ps') }}">Data Siswa</a>
                        </li>
                        <li>
                            <i class="bi bi-clipboard-data-fill"></i>
                            <a href="{{ route('latestsPs.home') }}">Data Rekap</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div id="content" class="" style=" width:auto; height: 100%">
                    @yield('content')
                </div>
            </div>
        </div>
    @endif

</body>

</html>
