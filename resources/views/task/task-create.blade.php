@extends('layout.app')
@include('includes.navbar')
@section('content')
    <div>
        <h1>Task</h1>
    </div>
    <div class="pt-5">
        <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <form action="{{ route('task.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control shadow-sm">
                        @foreach (categories() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror

                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control shadow-sm">
                    @error('title')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror

                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control shadow-sm">{{ old('description') }}</textarea>
                    @error('description')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror

                    <label for="entry_date">Entry Date</label>
                    <input type="date" id="entry_date" name="entry_date" value="{{ old('entry_date') }}" class="form-control shadow-sm">
                    @error('entry_date')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control shadow-sm">
                    @error('email')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror

                    <label for="document">Document</label>
                    <input type="file" accept="application/pdf" id="document" name="document" value="{{ old('document') }}" class="form-control shadow-sm">
                    @error('document')
                        <p style="color: brown;font-weight:bold;font-size:12px;">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-primary my-2">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
