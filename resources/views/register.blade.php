@extends('layout.app')
@section('content')
    <div>
        <h1>Register</h1>
    </div>
    <div class="p-5">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
            @error('name')
            <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
            @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email')
                <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
            @enderror

            <label for="role">Role</label>
            <select name="role" id="role" class="form-select">
                <option value="" disabled selected>Select Role</option>
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select>
            @error('role')
            <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="" class="form-control">
            @error('password')
            <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    </div>
@endsection
