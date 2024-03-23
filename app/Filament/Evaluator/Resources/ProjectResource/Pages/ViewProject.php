<?php

namespace App\Filament\Evaluator\Resources\ProjectResource\Pages;

use App\Filament\Evaluator\Resources\ProjectResource;
use App\Models\EvaluationPanel;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Storage;

class ViewProject extends Page
{
    protected static string $resource = ProjectResource::class;

    protected static string $view = 'filament.evaluator.resources.project-resource.pages.view-project';

    public Project $project;

    public $marks = [];

    public function mount(Project $record)
    {
        abort_unless($record->evaluation_panel_id === EvaluationPanel::authUser()->id, 403);

        $this->project = $record;
    }

    public function getTitle(): string|Htmlable
    {
        return $this->project->name;
    }

    public function downloadFileAction(): Action
    {
        return Action::make('downloadFileAction')
            ->icon('heroicon-o-arrow-down-tray')
            ->iconButton()
            ->action(function (array $arguments) {
                $file = ProjectFile::find($arguments['file']);

                return response()->streamDownload(function () use ($file) {
                    echo Storage::disk($file->storage_disk)->get($file->storage_path);
                }, $file->name);
            });
    }

    public function getStudentMarks(int $studentId): string
    {
        return $this->marks[''.$studentId] ?? '0';
    }

    public function editMarksAction()
    {
        return Action::make('editMarksAction')
            ->icon('heroicon-o-pencil')
            ->iconButton()
            ->fillForm(fn (array $arguments) => ['marks' => $this->getStudentMarks($arguments['student'])])
            ->form([
                TextInput::make('marks')
                    ->type('number')
                    ->minValue(0)
                    ->maxValue(100)
                    ->label('Marks')
                    ->required(),
            ])
            ->action(function (array $arguments, array $data) {
                $this->marks[''.$arguments['student']] = $data['marks'];
            });
    }

    public function saveMarksAction(): Action
    {
        return Action::make('saveMarksAction')
            ->label('Save Marks')
            ->icon('heroicon-o-check-circle')
//            ->iconButton()
            ->action(function () {

            });
    }
}
