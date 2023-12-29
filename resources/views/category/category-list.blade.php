@extends('layout.app')
@include('includes.navbar')
@section('content')
    <div>
        <h1>Category</h1>
    </div>
    <div class="pt-5">
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add Category</a>
        <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <h3>Active Categories</h3>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('category.update', ['id' => $category->id]) }}"
                                        class="btn btn-success mb-2"><i class="las la-edit" style="font-size: 20px;"></i></a>

                                    <form action="{{ route('category.remove', ['id' => $category->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="las la-trash-alt" style="font-size: 20px;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow p-3 my-5 bg-body-tertiary rounded">
            <div class="card-body">
                <h3>Trashed Categories</h3>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashed as $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">
                                    <form action="{{ route('category.restore', ['id' => $category->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success"><i class="las la-trash-restore-alt" style="font-size: 20px;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
