<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Models\Type;
use App\Models\Tecnology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('pages.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $tecnologies = Tecnology::all();

        return view('pages.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($request->name);
        $val_data['slug'] = $slug;


        if( $request->hasFile('cover_image') ){

            $path = Storage::disk('public')->put( 'project_images', $request->cover_image );


            $val_data['cover_image'] = $path;
        }


        $new_project = Project::create( $val_data );

        if( $request->has('tecnologies')){
            $new_project->tecnologies()->attach( $request->tecnologies );
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $tecnologies = Tecnology::all();

        return view('pages.edit', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($request->name);

        $val_data['slug'] = $slug;

        if( $request->hasFile('cover_image') ){
            if( $project->cover_image ){
                Storage::delete($project->cover_image);
            }

            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $val_data['cover_image'] = $path;
        }

        $project->update( $val_data );

        if( $request->has('tecnologies')){
            $project->tecnologies()->sync( $request->tecnologies );
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        $project->tecnologies()->sync([]);

        if( $project->cover_image ){
            Storage::delete($project->cover_image);
        };

        $project->delete();

        return redirect()->route('dashboard.projects.index');
    }
}
