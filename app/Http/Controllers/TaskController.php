<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        $trashed = Task::onlyTrashed()->latest()->get();
 
        return view('task.task-list', compact('tasks', 'trashed'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        return view('task.task-edit', compact('task'));
    }

    public function create(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'entry_date' => 'required|date',
            'email' => 'required|email',
            'document' => 'required|mimes:pdf'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $document = $request->file('document')->hashName();
        $doc_path = '/uploads/tasks/' . $document;
        $request->file('document')->storeAs('public/' . $doc_path);

        $taskData = [
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'entry_date' => $request->entry_date,
            'email' => $request->email,
            'document' => $doc_path
        ];



        $task = $user->tasks()->create($taskData);

        if($task)
        {
            $toMail = $taskData['email'];
            Notification::route('mail', $toMail)
                            ->notify(new TaskCreatedNotification($taskData));
        }

        return redirect()->route('task.list');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category' => 'nullable',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'entry_date' => 'nullable|date',
            'email' => 'nullable|email',
            'document' => 'nullable|mimes:png,jpeg,jpg,pdf,doc'
        ]);

        $updatables = [
            'category_id',
            'title',
            'description',
            'entry_date',
            'email',
            'document'
        ];

        $updatedData = [];

        foreach($updatables as $field)
        {
            if($request->filled($field))
            {
                $updatedData[$field] = $request->input($field);
            }
        }

        if($request->hasFile('document'))
        {
            $document = $request->file('document')->hashName();
            $doc_path = '/uploads/tasks/' . $document;
            $request->file('document')->storeAs('public/' . $doc_path);

            $document = $request->file('document');
            $doc_name = $document->hashName();
            $document->move('/uploads/tasks', $doc_name);
            $updatedData['document'] = $doc_name;
        }

        $task->update($updatedData);

        return redirect()->route('task.list');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->back();
    }
}
