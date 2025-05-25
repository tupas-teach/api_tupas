<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Project;

class MaterialController extends Controller
{
    // Get all materials
    public function getMaterials()
    {
        $materials = Material::with('project')->get(); // includes project info
        return response()->json(['materials' => $materials]);
    }

    // Add a new material
    public function addMaterial(Request $request)
    {
        $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'name'       => ['required', 'string', 'max:255'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'unit_cost'  => ['required', 'numeric', 'min:0'],
        ]);

        $material = Material::create([
            'project_id' => $request->project_id,
            'name'       => $request->name,
            'quantity'   => $request->quantity,
            'unit_cost'  => $request->unit_cost,
        ]);

        return response()->json([
            'message'  => 'Material added successfully',
            'material' => $material
        ]);
    }

    // Edit a material
    public function editMaterial(Request $request, $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'name'       => ['required', 'string', 'max:255'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'unit_cost'  => ['required', 'numeric', 'min:0'],
        ]);

        $material->update([
            'project_id' => $request->project_id,
            'name'       => $request->name,
            'quantity'   => $request->quantity,
            'unit_cost'  => $request->unit_cost,
        ]);

        return response()->json([
            'message'  => 'Material updated successfully',
            'material' => $material
        ]);
    }

    // Delete a material
    public function deleteMaterial($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        $material->delete();

        return response()->json(['message' => 'Material deleted successfully']);
    }
}

