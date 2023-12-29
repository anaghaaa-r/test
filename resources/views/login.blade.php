@extends('layout.app')
@section('content')
    <div>
        <h1>Login</h1>
    </div>
    <div class="p-5">
        @if (session('loginError'))
            <p style="color: brown;font-weight:bold;font-size:14px;" class="my-3">{{ session('loginError') }}</p>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email')
                <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="" class="form-control">
            @error('password')
                <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Login</button>
        </form>
    </div>
@endsection
