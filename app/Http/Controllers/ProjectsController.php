<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{

    /**
     * View all projects
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = Project::all();
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    /**
     * Show a single project
     * 
     * @param \App\Project $project
     * 
     * 
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));

    }

    public function store()
    {
        // validate date
        $attributes = $this->validateRequest();

        $project = auth()->user()->projects()->create($attributes);

        // redirect
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attributes = $this->validateRequest();
      
        $project->update($attributes);

        // redirect
        return redirect($project->path());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);
    }
}
