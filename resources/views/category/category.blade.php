@extends('layout.app')
@include('includes.navbar')
@section('content')
    <div>
        <h1>Category</h1>
    </div>
    <div class="pt-5">
        <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <form action="{{ route('category.save') }}" method="POST">
                    @csrf

                    <input type="hidden" name="category_id" value="{{ $category->id }}">

                    <label for="name">Category</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="form-control shadow-sm">
                    @error('name')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror
                    
                    <button type="submit" class="btn btn-primary my-2">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
