<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        //all projects without relationships
        // $projects = Project::all();

        //all projects with relative relationships (Types and Technologies tables)
        $projects = Project::with('type', 'technology')->paginate(4);

        return 
            response()->json([
                'success' => true,
                'projects' => $projects,
            ]);
    }

    public function show( $slug ){
        $projct = Project::with('type', 'technology')->where('slug', $slug)->first();
        return
            response()->json([
                "success" => true,
                "project" => $projct,
            ]);
    }
}
