<?php

namespace App\Filament\Evaluator\Resources\ProjectResource\Pages;

use App\Filament\Evaluator\Resources\ProjectResource;
use App\Models\EvaluationPanel;
use App\Models\Project;
use Filament\Resources\Pages\Page;

class ViewProject extends Page
{
    protected static string $resource = ProjectResource::class;

    protected static string $view = 'filament.evaluator.resources.project-resource.pages.view-project';


    public Project $project;

    public function mount(Project $record)
    {
        abort_unless($record->evaluation_panel_id === EvaluationPanel::authUser()->id, 403);

        $this->project = $record;
    }




}
