<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        if($tasks->count() == 0){
            return response()->json([
                "message"=> "No Tasks Found"
            ], 404);
        }

        return response()->json([
            "message"=> $tasks
        ], 200);
    }

    public function getTaskById($id) {
        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                "message" => "No Tasks Found"
            ], 401);
        }

        return response()->json([
            "message" => $task
        ], 200);
    }

    public function show($user_id) {
        $tasks = Task::where('user_id', $user_id)->get();

        if($tasks->isEmpty()) {
            return response()->json([
                "message" => "No Tasks Found"
            ], 401);
        }

        return response()->json([
            "message" => $tasks
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title"=> "required|string",
            "user_id"=> "required",
            "description"=> "required|string",
            "status"=> "string",
        ]);

        $task = Task::create($validated);

        return response()->json([
            "message"=> $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                "message"=> "No Tasks Found For Id " . $id
            ], 404);
        }

        $validated = $request->validate([
            "title"=> "required|string",
            "user_id"=> "required",
            "description"=> "required|string",
            "status"=> "string",
        ]);

        $task->update($validated);

        return response()->json([
            "message"=> $task
        ]);
    }

    public function updateStatus($id, $status) 
    {
        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                "message"=> "No Tasks Found For Id " . $id
            ], 404);
        }

        $task->status = $status;

        $task->save();
        return response()->json([
            "message" => $task
        ], 200);

    }

    public function deleteTask($id) {
        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                "message"=> "Task Not Found"
            ], 404);
        }

        $task->delete();

        return response()->json([
            "message" => "Task Deleted"
        ], 200);
    }
}
