@extends('layouts.template')
@section('content')
  <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Keterlambatan</h3>
            <p>Data Terlambat / Edit Data</p>
        </div>

        <div class="container bg-white" style="height:850px;">

        <div class="card bg-white border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">

<form action="{{ route('latests.update', $latests['id']) }}" enctype="multipart/form-data" method="post">
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
            <label for="student_id" class="mt-3 mb-3">Siswa </label>
            <select class="form-select" aria-label="Default select example" name="student_id" >
                @foreach ($students as $item)
                @if ($item['id'] === $latests['student_id'])
                <option value="{{ $latests['student_id'] }}">{{ $item['nama'] }}</option>
                @else
                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                @endif
                @endforeach
            </select>
            <label for="exampleInputEmail1" class="form-label mt-3 mb-3">Tanggal Keterlambatan</label>
            <input type="datetime-local" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="date_time_late" value="{{ $latests['date_time_late'] }}">

            <label for="exampleFormControlTextarea1" class="form-label mt-3 mb-3">Informasi</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="information">{{ $latests['information'] }}</textarea>

            <div class="mt-3">

            <label for="formFile" class="form-label">Bukti</label>
            <input class="form-control" type="file" id="bukti" name="bukti" value="{{ $latests['bukti'] }}">
            <label for="" class="" style="margin-right: 20px;">Bukti Sebelumnya:</label>
            <img src="{{ asset('images/' . $latests['bukti']) }}" style="width: 100px; height:auto; margin-bottom:20px;" class="img-fluid rounded-start mt-4" alt="">

            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary" style="margin-top: ; margin-right:20px">Update</button>
            </div>
        </form>
        </div>
        </div>
    </div>
@endsection
