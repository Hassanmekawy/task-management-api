<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->withCount('tasks')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $projects,
        ], 200);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = $request->user()->projects()->create($fields);

        return response()->json([
            'message' => 'Project created successfully',
            'data'    => $project,
        ], 201);
    }

    public function show(Request $request, Project $project)
    {
        // التأكد من أن المستخدم يملك هذا المشروع
        if ($project->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $project->load('tasks'),
        ], 200);
    }

    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $fields = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($fields);

        return response()->json([
            'message' => 'Project updated successfully',
            'data'    => $project,
        ], 200);
    }

    public function destroy(Request $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully',
        ], 200);
    }
}