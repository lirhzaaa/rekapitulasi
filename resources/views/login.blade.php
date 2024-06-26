<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Rekapitulasi Keterlambatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card" style="width: 750px; margin-left:300px; margin-top:150px;">
        <form action="{{ route('login.auth') }}" method="POST" class="card p-5">
            <h1 class="mb-3">Login</h1>
            @csrf
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            @if (Session::get('logout'))
                <div class="alert alert-danger">{{ Session::get('logout') }}</div>
            @endif
            @if (Session::get('canAccess'))
                <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
            @endif
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </div>

</body>

</html>
