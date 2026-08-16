<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->tasks()->with('project');

        // فلترة بحالة المهمة (pending, in_progress, completed) لو أرسلها المستخدم
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $query->get(),
        ], 200);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'project_id'  => 'required|exists:projects,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $fields['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $fields['user_id'] = $request->user()->id;

        $task = Task::create($fields);

        return response()->json([
            'message' => 'Task created successfully',
            'data'    => $task,
        ], 201);
    }

    public function show(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $task->load('project'),
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $fields = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'sometimes|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            if ($task->attachment) {
                Storage::disk('public')->delete($task->attachment);
            }
            $fields['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $task->update($fields);

        return response()->json([
            'message' => 'Task updated successfully',
            'data'    => $task,
        ], 200);
    }

    public function destroy(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($task->attachment) {
            Storage::disk('public')->delete($task->attachment);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ], 200);
    }
}