<?php

namespace App\Filament\Staff\Pages;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Models\Project;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class StartNewEvaluation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.staff.pages.start-new-evaluation';

    protected static ?string $navigationGroup = 'Evaluation';

    public ?array $data = null;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make()
                    ->submitAction(
                        $this->submitAction()
                    )
                    ->schema([
                        Wizard\Step::make('Enter Parameters')
                            ->afterValidation(function () {
                                $this->data['distribution'] = $this->loadProjectDistributions();
                            })
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Fieldset::make('Evaluation Event')->schema([
                                            TextInput::make('name')
                                                ->label('Evaluation Name')
                                                ->required(),

                                            TextInput::make('total_marks')
                                                ->label('Total Marks')
                                                ->integer()
                                                ->required(),

                                            DateTimePicker::make('start_datetime')
//                                                ->native(false)
                                                ->displayFormat('Y-m-d H:i A')
                                                ->default(now())
                                                ->label('Evaluation Start Date Time')
                                                ->required(),

                                            TextInput::make('per_project_duration')
                                                ->label('Per Project Duration')
                                                ->suffix('minutes')
                                                ->default(30)
                                                ->integer()
                                                ->required(),

                                            Checkbox::make('shuffle_evaluation_panels')
                                                ->label('Shuffle Evaluation Panels?'),

                                            Checkbox::make('is_final')
                                                ->label('Is Final Evaluation?'),

                                        ])->columnSpan(1),
                                        Fieldset::make('Projects Configuration')
                                            ->schema([
                                                Select::make('included_terms')
                                                    ->label('Included Terms')
                                                    ->options(ProjectTerm::class)
                                                    ->multiple()
                                                    ->columnSpan(2)
                                                    ->default(ProjectTerm::cases()),
                                                Select::make('included_project_status')
                                                    ->label('Included Status')
                                                    ->options(ProjectStatus::class)
                                                    ->multiple()
                                                    ->columnSpan(2)
                                                    ->default(ProjectStatus::cases()),
                                                Select::make('included_project_approval_status')
                                                    ->label('Included Approval Status')
                                                    ->options(ProjectApprovalStatus::class)
                                                    ->multiple()
                                                    ->columnSpan(2)
                                                    ->default(ProjectApprovalStatus::cases()),
                                            ])->columnSpan(1),
                                    ]),

                            ]),
                        Wizard\Step::make('Edit Distribution')
                            ->schema([
                                Repeater::make('distribution')
                                    ->label('Project Distribution')
                                    ->columns(2)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->schema([
                                        TextInput::make('project_name')
                                            ->label('Project Name')
                                            ->disabled(),

                                        DateTimePicker::make('next_evaluation_date')
                                            ->label('Next Evaluation Date')
                                            ->required(),
                                    ]),

                            ]),
                    ]),
            ])
            ->statePath('data')
            ->fill($this->data);
    }

    public function loadProjectDistributions(): array
    {
        $projects = Project::query()
            ->whereIn('term', $this->data['included_terms'])
            ->whereIn('status', $this->data['included_project_status'])
            ->whereIn('approval_status', $this->data['included_project_approval_status'])
            ->get();

        if ($projects->count() === 0) {
            Notification::make()
                ->title('No Projects Found')
                ->body('No projects found with the given criteria.')
                ->danger()
                ->send();

            throw new Halt('No projects found with the given criteria.');
        }

        $distribution = [];
        $startDateTime = $this->data['start_datetime']; //2024-05-07T16:00
        foreach ($projects as $project) {
            $distribution[] = [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'next_evaluation_date' => $startDateTime,
            ];

            $startDateTime = Carbon::parse($startDateTime)
                ->addMinutes($this->data['per_project_duration'])
                ->toDateTimeLocalString();
        }

        return $distribution;
    }

    public function submitAction()
    {
        return Action::make('submitAction')
            ->label('Submit')
            ->action(function () {
                dd($this->data);
            });
    }
}
