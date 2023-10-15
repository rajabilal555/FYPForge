<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Staff/Project/ProjectList', [
            'data' => Project::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $model): Response
    {
        return Inertia::render('Staff/Project/ProjectView', [
            'model' => $model->only([
                'id',
                // add more fields to send to user
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $model): Response
    {
        return Inertia::render('Staff/Project/ProjectEdit', [
            'model' => $model->only([
                'id',
                // add more fields to send to user
            ])
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $model): RedirectResponse
    {
        $data = $request->validate([
            //Validation
        ]);
        $model->fill($data)->save();
        return redirect()->route('model.index')->with('flash_message', 'Model updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $model)
    {
        //
    }
}
