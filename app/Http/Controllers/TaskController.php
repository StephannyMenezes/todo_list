<?php

namespace App\Http\Controllers;

use App\Models\Task;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view("tasks.index", compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tasks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        Task::create($request->all());
        return redirect()->route("tasks.index")->with("Success", "Task created sucessfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view("tasks.edit", compact("task"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view("tasks.edit", compact("task"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            "name" => "required"
        ]);

        $task->update($request->all());

        return redirect()->route("tasks.index")->with("success", "Task Updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route("tasks.index")->with("success", "Task deleted successfully");
    }
}
