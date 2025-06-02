<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        $tasks->load('user');

        return response()->json([
            'status' => true,
            'message' => 'Tasks loaded successfully',
            'tasks' => $tasks
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the user_id 
        $user = auth('api')->user();

        // Create a new task
        $task = new Task();
        $task->user_id = $user->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->category = $request->category;
        $task->star_date = $request->star_date;
        $task->end_date = $request->end_date;
        $task->status = "Created";
        $task->save();

        // Include the user data in the task object
        $task->load('user');

        // Return the new task
        return response()->json([
            'status' => true,
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id); // Find the task

        // validate if the task exist
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404); // Return 404 if the task doesn´t exist
        }

        $task->load('user');

        return response()->json([
            'status' => true,
            'message' => 'Tasks loaded successfully',
            'tasks' => $task
        ], 201);// Return the task
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id); // Find the task

        // validate if the task exist
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404); // Return 404 if the task doesn´t exist
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->category = $request->category;
        $task->star_date = $request->star_date;
        $task->end_date = $request->end_date;
        $task->status = $request->status;
        $task->update();

        $task->load('user');

        return response()->json([
            'status' => true,
            'message' => 'Tasks updated successfully',
            'tasks' => $task
        ], 201); // Return the task
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id); // Find the task
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404); // Return 404 if the task doesn´t exist
        }
        $task->delete(); // Delete the task
        return response()->json(['message' => 'Task deleted'], 200); // Return 200 status code
    }
}
