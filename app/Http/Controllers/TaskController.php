<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $request->validate(([
            'title' => 'required|max:20',
        ]));

        $task = new Task();
        $task->title = $request->input('title');
        $task->save();

        return redirect('/');
    }

    public function update(Request $request, Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();

        return redirect('/');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect('/');
    }
}
