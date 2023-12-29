@extends('layout.app')
@include('includes.navbar')
@section('content')
    <div>
        <h1>Task</h1>
    </div>
    <div class="pt-5">
        <a href="{{ route('task.create') }}" class="btn btn-primary mb-3">Add Task</a>
        <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <h3>Active Tasks</h3>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Entry Date</th>
                            <th class="text-center">Download Document</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $task->category->name }}</td>
                                <td class="text-center">{{ $task->title }}</td>
                                <td class="text-center">{{ $task->description }}</td>
                                <td class="text-center">{{ $task->entry_date }}</td>
                                <td class="text-center"><a href="{{ asset('storage/' . $task->document) }}" target="_blank"><i class="las la-cloud-download-alt" style="font-size: 20px;"></i></a></td>
                                <td class="text-center">
                                    <a href="{{ route('task.edit', ['id' => $task->id]) }}"
                                        class="btn btn-success mb-2"><i class="las la-edit" style="font-size: 20px;"></i></a>

                                    <form action="{{ route('task.remove', ['id' => $task->id]) }}"
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
                <h3>Trashed Tasks</h3>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Entry Date</th>
                            <th class="text-center">Download Document</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashed as $task)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $task->category->name }}</td>
                                <td class="text-center">{{ $task->title }}</td>
                                <td class="text-center">{{ $task->description }}</td>
                                <td class="text-center">{{ $task->entry_date }}</td>
                                <td class="text-center"><a href="{{ asset('storage/' . $task->document) }}" download=""><i class="las la-cloud-download-alt" style="font-size: 20px;"></i></a></td>
                                <td>
                                <form action="{{ route('task.restore', ['id' => $task->id]) }}"
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
