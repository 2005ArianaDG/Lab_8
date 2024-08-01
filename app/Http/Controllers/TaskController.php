<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $tasks = Task::with('priority', 'user', 'tags')->get(); 
        return view('home', compact('tasks'));
    }

    public function dashboard()
    {
        $tasks = Task::with('priority', 'user', 'tags')->get(); 
        return view('dashboard', compact('tasks'));
    }

    public function create(Task $task)
    {
        return view('tasks.create', [
            'task' => $task,
            'priorities' => Priority::all(),
            'users' => User::all(),
            'tags' => Tag::all()
        ]);
    }

    public function show(Task $task)
    {

        $this->authorize('view', $task);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'priority_id' => ['required', 'exists:priorities,id'],
            'user_id' => ['required', 'exists:users,id'],
            'tags' => ['nullable', 'array'],
        ]);

        $task = Task::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'priority_id' => $data['priority_id'],
            'user_id' => $data['user_id'],
        ]);

        if (isset($data['tags'])) {
            $task->tags()->attach($data['tags']);
        }

        return redirect('/tasks')->with('success', 'Tarea creada exitosamente.');
    }

    public function delete(Task $task)
    {

        $this->authorize('delete', $task);

        $task->delete();
        return redirect('/tasks');
    }

    public function edit(Task $task)
    {

        $this->authorize('update', $task);

        return view('tasks.edit', [
            'task' => $task,
            'priorities' => Priority::all(),
            'users' => User::all(),
            'tags' => Tag::all()
        ]);
    }

    public function update(Request $request, Task $task)
    {

        $this->authorize('update', $task);

        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'user_id' => 'required|exists:users,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $task->fill($data)->save();

        if (isset($data['tags'])) {
            $task->tags()->sync($data['tags']);
        } else {

            $task->tags()->detach();
        }

        return redirect('/tasks/' . $task->id);
    }

    public function complete(Task $task)
    {
   
        $task->completed = true;
        $task->save();

        return redirect('/tasks');
    }
}
