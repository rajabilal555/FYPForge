<?php

namespace App\Filament\Staff\Pages;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Filament\Staff\Resources\EvaluationEventResource;
use App\Models\EvaluationEvent;
use App\Models\EvaluationPanel;
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

    public ?array $evaluationPanels;

    public function mount()
    {
        $this->evaluationPanels = EvaluationPanel::all()->pluck('name', 'id')->toArray();
    }

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
                                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'If enabled, evaluation panels will be shuffled for each project. Also makes sure that all projects are assigned to an evaluation panel.')
                                                ->label('Re-assign Evaluation Panels?'),

                                            Checkbox::make('is_final_evaluation')
                                                ->label('Is Final Evaluation?'),

                                        ])->columnSpan(1),
                                        Fieldset::make('Projects Inclusion Configuration')
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
                                            ->columnSpan(fn () => $this->data['shuffle_evaluation_panels'] === false ? 1 : 2)
                                            ->disabled(),

                                        DateTimePicker::make('evaluation_date')
                                            ->label('Next Evaluation Date')
                                            ->required(),

                                        Select::make('evaluation_panel_id')
                                            ->hidden(fn () => $this->data['shuffle_evaluation_panels'] === false)
                                            ->label('Evaluation Panel')
                                            ->options(fn () => $this->evaluationPanels)
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
        // refresh evaluation panels
        $this->evaluationPanels = EvaluationPanel::all()->pluck('name', 'id')->toArray();

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

        if ($this->data['shuffle_evaluation_panels'] === true) {
            $panels = EvaluationPanel::inRandomOrder()->get();
        }

        foreach ($projects as $i => $project) {
            if ($this->data['shuffle_evaluation_panels'] === true) {
                $project->evaluation_panel_id = $panels[$i % $panels->count()]->id;
            }

            $distribution[] = [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'evaluation_date' => $startDateTime,
                'evaluation_panel_id' => $project->evaluation_panel_id,
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
                try {
                    $distribution = $this->data['distribution'];

                    // create an evaluation event
                    $event = EvaluationEvent::create([
                        'name' => $this->data['name'],
                        'total_marks' => $this->data['total_marks'],
                        'start_datetime' => $this->data['start_datetime'],
                        'per_project_duration' => $this->data['per_project_duration'],
                        'is_final_evaluation' => $this->data['is_final_evaluation'],
                        'shuffle_evaluation_panels' => $this->data['shuffle_evaluation_panels'],
                    ]);

                    foreach ($distribution as $data) {
                        $project = Project::find($data['project_id']);

                        $project->evaluation_panel_id = $data['evaluation_panel_id'];
                        $project->evaluationEvents()->attach($event, ['evaluation_date' => $data['evaluation_date']]);

                        $project->save();
                    }

                    Notification::make()
                        ->title('Success')
                        ->body('Evaluation event created successfully.')
                        ->success()
                        ->send();

                    $this->redirect(EvaluationEventResource::getUrl());

                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Error')
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }
}
