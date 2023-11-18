<?php

namespace App\Filament\Advisor\Resources\MyProjectResource\Pages;

use App\Filament\Advisor\Resources\MyProjectResource;
use App\Models\Advisor;
use App\Models\Project;
use App\Models\ProjectFile;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
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

    public function downloadFileAction(): Action
    {
        return Action::make('downloadFileAction')
            ->icon('heroicon-o-arrow-down-tray')
            ->iconButton()
            ->action(function (array $arguments) {
                $file = ProjectFile::find($arguments['file']);
                return response()->streamDownload(function () use ($file) {
                    echo Storage::disk($file->storage_disk)->get($file->storage_path);
                }, $file->name . '.' . $file->getFileType());
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
//                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'image',])
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

}
