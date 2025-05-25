<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;

class ProjectController extends Controller
{
    // Get all projects
    public function getProjects()
    {
        $projects = Project::with('client')->get(); // include related client
        return response()->json(['projects' => $projects]);
    }

    // Add a new project
    public function addProject(Request $request)
    {
        $request->validate([
            'client_id'   => ['required', 'exists:clients,id'],
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'      => ['required', 'in:pending,in_progress,completed'],
        ]);

        $project = Project::create([
            'client_id'   => $request->client_id,
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'status'      => $request->status,
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }

    // Edit a project
    public function editProject(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $request->validate([
            'client_id'   => ['required', 'exists:clients,id'],
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'      => ['required', 'in:pending,in_progress,completed'],
        ]);

        $project->update([
            'client_id'   => $request->client_id,
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'status'      => $request->status,
        ]);

        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    // Delete a project
    public function deleteProject($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}

