@extends('layouts.template')
@section('content')
  <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Rayon</h3>
            <p>Home / Data Siswa / Update Data</p>
        </div>
<form action="{{ route('students.update', $students['id']) }}" method="post">
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
            <div class="container bg-white" style="height:850px;">
            <div class="card bg-white border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nis</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nis" value="{{ $students['nis'] }}">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" value="{{ $students['nama'] }}">
            </div>

            <div class="mb-3">
            <label for="rombels" class="mt-3">Rombel </label>
            <select class="form-select mt-3" aria-label="Default select example" name="rombel_id">
                <option value="{{ $students['rombel_id'] }}" selected>Open this select menu</option>
            @foreach ($rombels as $item)
                <option value="{{ $item['id'] }}">{{ $item['rombels'] }}</option>
            @endforeach
            </select>
            </div>

            <div class="mb-3">
            <label for="rayons" class="mt-3">Rayons </label>
            <select class="form-select mt-3" aria-label="Default select example" name="rayon_id">
                <option value="{{ $students['rayon_id'] }}" selected>Open this select menu</option>
            @foreach ($rayons as $item)
                <option value="{{ $item['id'] }}">{{ $item['rayons'] }}</option>
            @endforeach
            </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>

        </form>
    </div>
    </div>
    </div>
@endsection
