<?php

namespace App\Filament\Evaluator\Resources\ProjectResource\Pages;

use App\Actions\SubmitEvaluation;
use App\Filament\Evaluator\Resources\ProjectResource;
use App\Models\EvaluationPanel;
use App\Models\Project;
use App\Models\ProjectFile;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ViewProject extends Page
{
    protected static string $resource = ProjectResource::class;

    protected static string $view = 'filament.evaluator.resources.project-resource.pages.view-project';

    public Project $project;

    public bool $submitted;

    public Collection $evaluation;

    public function mount(Project $record)
    {
        abort_unless($record->evaluation_panel_id === EvaluationPanel::authUser()->id, 403);

        $this->project = $record;
        $this->evaluation = collect();
        $this->submitted = $this->project->hasCurrentEvaluation();
        if ($this->submitted) {
            foreach ($this->project->getCurrentEvaluations() as $evaluation) {
                $studentId = $evaluation->student_id;
                $this->evaluation->put("$studentId.marks", $evaluation->marks);
                $this->evaluation->put("$studentId.remarks", $evaluation->comments);
            }
        }
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

    public function getStudentMarks(int $studentId): ?string
    {
        return $this->evaluation->get("$studentId.marks");
    }

    public function getStudentRemarks(int $studentId): ?string
    {
        return $this->evaluation->get("$studentId.remarks");
    }

    public function editMarksAction()
    {
        return Action::make('editMarksAction')
            ->icon('heroicon-o-pencil')
            ->iconButton()
            ->modalWidth('md')
            ->label(fn (array $arguments) => 'Edit Marks ('.$this->project->students->find($arguments['student'])->name.')')
            ->fillForm(fn (array $arguments) => ['marks' => $this->getStudentMarks($arguments['student']), 'remarks' => $this->getStudentRemarks($arguments['student'])])
            ->form([
                TextInput::make('marks')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->label('Marks')
                    ->suffix('out of 100%')
                    ->hidden(fn () => ! $this->project->is_final_evaluation)
                    ->required(),
                Textarea::make('remarks')
                    ->required()
                    ->label('Remarks'),
            ])
            ->action(function (array $arguments, array $data) {
                $studentId = $arguments['student'];
                if ($this->project->is_final_evaluation) {
                    $this->evaluation->put("$studentId.marks", $data['marks']);
                }
                $this->evaluation->put("$studentId.remarks", $data['remarks']);
            });
    }

    public function saveMarksAction(): Action
    {
        return Action::make('saveMarksAction')
            ->label('Submit Evaluation')
            ->icon('heroicon-o-check-circle')
            ->color(fn () => $this->project->is_final_evaluation ? 'danger' : 'primary')
            ->disabled(fn () => $this->project->hasCurrentEvaluation())
            ->action(function () {
                $this->submitted = SubmitEvaluation::make()->handle($this->project, $this->getStudentMarks(...), $this->getStudentRemarks(...));

            });
    }
}
