@extends('layouts.template')
@section('content')

  <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Rombel</h3>
            <p>Home / Data Rombel / Tambah Data</p>
        </div>



            <div class="container bg-white" style="height:850px;">

<div class="card bg-white border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-body ">
        <form action="{{ route('rombels.store') }}" method="post">
            @csrf
            @if (Session::get('success'))
            <div class="alert">{{ Session::get('success') }}</div>
            @endif
            @if ($errors->any())
            <ul>
                <li>@foreach ($errors->all() as $error)
                    <li>$error</li>
                @endforeach</li>
            </ul>
            @endif
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Rombels</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rombels">
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>
            </div>
@endsection
