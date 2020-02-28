<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        $html = view('app.parts.task', compact('task'))->render();
        return response()->json(['html' => $html]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function complete(Task $task)
    {
        $task->complete();
    }

    public function incomplete(Task $task)
    {
        return $task->incomplete();
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
    }

    public function destroy(Task $task)
    {
        $task->delete();
    }
}
