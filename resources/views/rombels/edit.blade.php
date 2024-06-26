@extends('layouts.template')
@section('content')
 <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Rombel</h3>
            <p>Home / Data Rombel / Ubah Data</p>
        </div>
<div class="container bg-white" style="height:850px;">
<div class="card bg-white border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-body">
<form action="{{ route('rombels.update', $rombels['id']) }}" method="post">
    @csrf
    @method('PATCH')

    @if ($errors->any())
    <ul>
        @foreach ($erros->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
     <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Rombels</label>
            <input type="text" class="form-control" id="exampleInputEmail1"  name="rombels" value="{{ $rombels['rombels'] }}">
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
</form>
    </div>
</div>
  </div>
@endsection
