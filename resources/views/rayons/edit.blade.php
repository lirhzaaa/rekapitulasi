@extends('layouts.template')
@section('content')
 <div class="text" style="
            margin-top:20px;
            margin-left:20px;
            ">
            <h3>Data Rayon</h3>
            <p>Home / Data Rayon / Ubah Data</p>
        </div>

        <div class="container bg-white" style="height:850px;">
<div class="card bg-white border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-body">

<form action="{{ route('rayons.update', $rayons['id']) }}" method="post">
    @csrf
    @method('PATCH')

    @if ($errors->any())
    <ul>
        <li>@foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach</li>
    </ul>
    @endif

      <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Rayon</label>
            <input type="text" class="form-control" id="exampleInputEmail1"  name="rayons" value="{{ $rayons['rayons'] }}">
        </div>

            <label for="user_id" class="mt-3">Pembimbing</label>
            <select class="form-select mt-3" aria-label="Default select example" name="user_id">
                <option value="{{ $rayons['user_id'] }}" selected>Pilih Disini</option>
        @foreach ($userOtherData as $item)
        @if ($item['role'] === "ps")
        <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
        @endif
        @endforeach
    </select>
        <button type="submit" class="btn btn-primary mt-5">Ubah</button>
</form>
    </div>
</div>
</div>
@endsection
