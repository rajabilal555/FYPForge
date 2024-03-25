<?php

namespace App\Filament\Advisor\Resources\MyProjectResource\Pages;

use App\Actions\AnswerProjectQuery;
use App\Actions\InviteProjectMember;
use App\Enums\ProjectTaskStatus;
use App\Filament\Advisor\Resources\MyProjectResource;
use App\Models\Advisor;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectMemberInvite;
use App\Models\ProjectQuery;
use App\Models\ProjectTask;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ViewMyProject extends Page
{
    protected static string $resource = MyProjectResource::class;

    protected static string $view = 'filament.advisor.resources.my-project-resource.pages.view-my-project';

    public Project $project;

    public function mount(Project $record)
    {
        abort_unless($record->advisor_id === Advisor::authUser()->id, 403);

        $this->project = $record;
    }

    public function getHeader(): ?View
    {
        return view('components.project-header', [
            'project' => $this->project,
            'heading' => $this->project->name,
            'actions' => $this->getHeaderActions(),
        ]);
    }

    public function removeMemberAction(): Action
    {
        return Action::make('removeMemberAction')
//            ->label('Remove Member')
            ->icon('heroicon-o-x-circle')
            ->iconButton()
            ->color('danger')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                //TODO: can use eloquent relations to disassociate this relation.
                $student = Student::find($arguments['student']);
                $student->update([
                    'project_id' => null,
                ]);
            });
    }

    public function cancelMemberInviteAction(): Action
    {
        return Action::make('cancelMemberInviteAction')
            ->icon('heroicon-o-x-mark')
            ->iconButton()
            ->color('danger')
            ->action(function (array $arguments) {
                $invite = ProjectMemberInvite::find($arguments['invite']);
                $invite->delete();
            });
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
                }, $file->name.'.'.$file->getFileType());
            });
    }

    public function deleteFileAction(): Action
    {
        return Action::make('deleteFileAction')
            ->label('Delete File')
            ->icon('heroicon-o-trash')
            ->iconButton()
            ->color('danger')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                $file = ProjectFile::find($arguments['file']);
                $file?->delete();
                Storage::disk($file->storage_disk)->delete($file->storage_path);
            });
    }

    public function uploadFileAction(): Action
    {
        return Action::make('uploadFileAction')
            ->label('Upload File')
            ->icon('heroicon-o-arrow-up-tray')
            ->record($this->project)
            ->extraAttributes([
                'class' => 'mt-5 w-full',
            ])
            ->form([
                TextInput::make('document_name')
                    ->label('Document Name')
                    ->required(),

                FileUpload::make('document')
                    ->afterStateUpdated(function (Set $set, TemporaryUploadedFile $state) {
                        $set('document_name', $state->getClientOriginalName());
                    })
//                  ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'image',])
                    ->maxSize(1024 * 20)
                    ->label('Document')
                    ->disk('private')
                    ->directory('project-files')
                    ->visibility('private')
                    ->required(),
            ])
            ->action(function (Project $project, array $data) {
                return $project->files()->create([
                    'name' => $data['document_name'],
                    'storage_path' => $data['document'],
                    'storage_disk' => 'private',
                    'student_id' => auth()->id(),
                ]);
            });
    }

    public function viewQueryAction(): Action
    {
        return Action::make('viewQueryAction')
            ->icon('heroicon-o-eye')
            ->iconButton()
//          ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->fillForm(fn (array $arguments) => ProjectQuery::find($arguments['query'])->toArray())
            ->modalHeading('View Query')
            ->form([
                Section::make('Query')
                    ->collapsible()
                    ->compact()
                    ->schema([
                        MarkdownEditor::make('query')
                            ->label('')
                            ->disabled(),
                    ]),
                Section::make('Answer')
                    ->collapsible()
                    ->compact()
                    ->schema([
                        MarkdownEditor::make('answer')
                            ->label('')
                            ->required(),
                    ]),
            ])
            ->action(fn (array $arguments, array $data) => AnswerProjectQuery::make()->handle(ProjectQuery::find($arguments['query']), $data['answer']));
    }

    public function createTaskAction(): Action
    {
        return Action::make('createTaskAction')
            ->label('Create Task')
            ->icon('heroicon-o-plus')
            ->record($this->project)
            ->extraAttributes([
                'class' => 'mt-5 w-full',
            ])
            ->form([
                Grid::make([
                    'default' => 1,
                    'md' => 2,
                ])
                    ->schema([
                        TextInput::make('task_name')
                            ->label('Task Title')
                            ->required(),
                        DatePicker::make('task_due_date')
                            ->label('Due Date'),
                    ]),
                MarkdownEditor::make('task_description')
                    ->label('Description')
                    ->required(),
            ])
            ->action(function (Project $project, array $data) {
                return $project->tasks()->create([
                    'name' => $data['task_name'],
                    'description' => $data['task_description'],
                    'due_date' => $data['task_due_date'],
                ]);
            });
    }

    public function viewTaskAction(): Action
    {
        return Action::make('viewTaskAction')
            ->icon('heroicon-o-eye')
            ->iconButton()
//            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->fillForm(fn (array $arguments) => ProjectTask::find($arguments['task'])->toArray())
            ->modalHeading('View Task')
            ->form([
                Radio::make('status')
                    ->label('Status')
                    ->inline()
                    ->options(ProjectTaskStatus::class),

                Grid::make([
                    'default' => 1,
                    'md' => 2,
                ])
                    ->schema([
                        TextInput::make('name')
                            ->label('Task Title')
                            ->disabled(),
                        DatePicker::make('due_date')
                            ->hidden(fn ($state) => $state === null)
                            ->label('Due Date')
                            ->disabled(),
                    ]),
                MarkdownEditor::make('description')
                    ->label('Description')
                    ->disabled(),
            ])->action(function (array $arguments, array $data) {
                ProjectTask::find($arguments['task'])->update([
                    'status' => $data['status'],
                ]);
            });
    }
}
