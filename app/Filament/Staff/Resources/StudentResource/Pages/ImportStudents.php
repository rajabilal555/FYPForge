<?php

namespace App\Filament\Staff\Resources\StudentResource\Pages;

use App\Actions\ImportStudentsAction;
use App\Filament\Staff\Resources\StudentResource;
use App\Traits\CanImportCsv;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImportStudents extends Page implements HasForms
{
    use CanImportCsv;
    use InteractsWithForms;

    protected static string $resource = StudentResource::class;

    protected static string $view = 'filament.staff.resources.student-resource.pages.import-students';

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make()
                    ->submitAction(
                        $this->importStudents()
                    )
                    ->steps([
                        Wizard\Step::make('Upload CSV File')
                            ->schema([
                                FileUpload::make('file')
                                    ->required()
                                    ->acceptedFileTypes(['text/csv', 'text/plain'])
                                    ->afterStateUpdated(function (?TemporaryUploadedFile $state, Set $set) {
                                        try {
                                            if ($state == null) {
                                                $set('csv_data', null);

                                                return;
                                            }
                                            $csvData = $this->getCSVData($state->get())->all();

                                            $set('csv_data', $csvData);
                                        } catch (\Exception $e) {
                                            $set('csv_data', null);
                                            Notification::make('error')
                                                ->title('An error occured')
                                                ->body($e->getMessage())
                                                ->color('danger');
                                        }
                                    })
                                    ->label('CSV File'),
                            ]),

                        Wizard\Step::make('Review Students')
                            ->schema([
                                Repeater::make('csv_data')
                                    ->label('Import Data')
                                    ->reorderable(false)
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('registration_no')->required(),
                                        TextInput::make('name')->required(),
                                        TextInput::make('email')->required(),
                                    ]),
                            ]),

                    ]),
            ])
            ->statePath('data');
    }

    public function importStudents(): Action
    {
        return Action::make('importStudents')
            ->label('Import Students')
            ->action(function () {
                if (ImportStudentsAction::make()->handle($this->data['csv_data'])) {
                    return redirect(StudentResource::getUrl());
                }
            });
    }
}
