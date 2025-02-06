<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
    public $categories, $statusLabels;

    public function __construct()
    {
        $this->categories = Category::all();
        $this->statusLabels = Task::statusText();
    }
    public function index()
    {
        $filters = request()->all();

        $tasks = auth()->user()->tasks()->filter($filters)->with('category')->paginate(10);
        $categories = $this->categories;
        $statusLabels = $this->statusLabels;
        return inertia('Tasks/Index', get_defined_vars());
    }

    public function create()
    {
        $categories = $this->categories;
        $statusLabels = $this->statusLabels;

        return inertia('Tasks/Create', get_defined_vars());
    }


    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        auth()->user()->tasks()->create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }


    public function edit(string $id)
    {
        $categories = $this->categories;
        $statusLabels = $this->statusLabels;
        $task = auth()->user()->tasks()->findOrFail($id);

        return inertia('Tasks/Edit', get_defined_vars());
    }


    public function update(TaskRequest $request, string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $data = $request->validated();
        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }


    public function destroy(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function done(string $id)
    {
        $task = auth()->user()->tasks()->filter(['status' => '0'])->findOrFail($id);
        $task->update(['status' => '1']);

        return redirect()->route('tasks.index')->with('success', 'Task completed successfully');
    }

    public function forceDelete(string $id)
    {
        $task = auth()->user()->tasks()->withTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted permanently');
    }

    public function restore(string $id)
    {
        $task = auth()->user()->tasks()->withTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('tasks.index')->with('success', 'Task restored successfully');
    }
}
