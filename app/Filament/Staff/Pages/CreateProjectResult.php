<?php

namespace App\Filament\Staff\Pages;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Filament\Staff\Resources\EvaluationEventResource;
use App\Models\EvaluationEvent;
use App\Models\Project;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class CreateProjectResult extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.staff.pages.create-project-result';

    protected static ?string $navigationGroup = 'Evaluation';

    public ?array $data = null;

    public function mount()
    {
        $this->form->fill($this->data);
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
                                $this->prepareMarksStep();
                            })
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Grid::make(1)
                                            ->schema([
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

                                                        Actions::make([
                                                            Actions\Action::make('fetch_projects')
                                                                ->label('Fetch Projects')
                                                                ->button()
                                                                ->action(function (Set $set, Get $get) {
                                                                    $set('included_projects', Project::whereIn('term', $get('included_terms'))
                                                                        ->whereIn('status', $get('included_project_status'))
                                                                        ->whereIn('approval_status', $get('included_project_approval_status'))
                                                                        ->pluck('id')->map(fn ($item) => "$item")->toArray());
                                                                }),
                                                        ])->columnSpan(2)->fullWidth(),
                                                    ])->columnSpan(1),

                                                Fieldset::make('Projects Inclusion Configuration')
                                                    ->schema([
                                                        Select::make('included_projects')
                                                            ->required()
                                                            ->label('Included Projects')
                                                            ->multiple()
                                                            ->searchable()
                                                            ->options(fn (Get $get) => Project::whereIn('id', $get('included_projects'))->pluck('name', 'id'))
//                                                            ->getSelectedRecordUsing(fn ($value) => Project::find($value))
                                                            ->getOptionLabelUsing(fn ($value): ?string => Project::find($value)?->name)
                                                            ->getSearchResultsUsing(function (string $search): array {
                                                                return Project::where('name', 'like', "%$search%")->limit(20)->pluck('name', 'id')->toArray();
                                                            })
                                                            ->columnSpan(2),
                                                    ])->columnSpan(1),
                                            ])->columnSpan(1),
                                        Fieldset::make('Evaluation Events to Include')
                                            ->schema([
                                                CheckboxList::make('included_evaluation_events')
                                                    ->label('Included Evaluation Events')
                                                    ->required()
                                                    ->searchable()
                                                    ->options(EvaluationEvent::where('result_generated', false)->pluck('name', 'id'))
                                                    ->bulkToggleable()
                                                    ->descriptions(EvaluationEvent::where('result_generated', false)->pluck('start_datetime', 'id'))
                                                    ->columnSpan(2),
                                            ])->columnSpan(1),
                                    ]),

                            ]),
                        Wizard\Step::make('Finalize')
                            ->schema([

                                Repeater::make('marks')
                                    ->label('Student Marks')
                                    ->columns(2)
                                    ->reorderable(false)
                                    ->addable(false)
                                    ->schema([
                                        TextInput::make('student_name')
                                            ->label('Student Name')
                                            ->disabled(),
                                        TextInput::make('total_marks')
                                            ->label('Total Marks')
                                            ->disabled(),

                                        TextInput::make('total_marks_obtained')
                                            ->label('Total Marks Obtained'),

                                        KeyValue::make('using_evaluations')
                                            ->label('Using Evaluations')
                                            ->disabled()
                                            ->keyLabel('Evaluation Event')
                                            ->valueLabel('Marks'),

                                    ]),

                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function prepareMarksStep()
    {
        // get all students in the selected projects

        $students = Project::whereIn('id', $this->data['included_projects'])->with('students')->get()->pluck('students')->flatten();

        // get the selected project evaluations of the selected projects in selected evaluation events
        $studentEvaluations = Student::whereIn('project_id', $this->data['included_projects'])
            ->with('evaluations')
            ->get()
            ->pluck('evaluations')
            ->flatten()
            ->whereIn('evaluation_event_id', $this->data['included_evaluation_events']);

        // group by student
        $studentEvaluations = $studentEvaluations->groupBy('student_id');

        // get the total marks of the selected evaluation events
        $totalMarks = EvaluationEvent::whereIn('id', $this->data['included_evaluation_events'])->sum('total_marks');

        /**
         * @var \Illuminate\Support\Collection $studentEvaluations
         */
        $this->data['marks'] = $studentEvaluations->map(function ($value, $key) use ($totalMarks) {
            // total all the evaluation marks
            $student = Student::find($key);

            return [
                'student_id' => $student->id,
                'student_name' => $student->name,
                'registration_no' => $student->registration_no,
                'total_marks' => $totalMarks,
                'total_marks_obtained' => $value->sum('marks'),
                'using_evaluations' => $value->pluck('marks', 'evaluation_event_id')->toArray(),
                'marks_breakdown_data' => $value->select(['evaluation_event_id', 'marks', 'comments'])->toArray(),
            ];
        })->toArray();
    }

    public function submitAction()
    {
        return Action::make('submitAction')
            ->label('Submit')
            ->action(function () {
                try {
                    $this->validate([
                        'data.marks' => 'required|array',
                        'data.marks.*.student_id' => 'required|exists:students,id',
                        'data.marks.*.total_marks' => 'required|numeric',
                        'data.marks.*.total_marks_obtained' => 'required|numeric',
                        'data.marks.*.using_evaluations' => 'required|array',
                        'data.marks.*.using_evaluations.*' => 'required|numeric',
                    ]);

                    foreach ($this->data['marks'] as $mark) {
                        $student = Student::find($mark['student_id']);
                        $project = Project::find($student->project_id);

                        $projectResult = $project->results()->create([
                            'student_id' => $student->id,
                            'evaluation_event_ids' => $this->data['included_evaluation_events'],
                            'total_marks' => $mark['total_marks'],
                            'total_marks_obtained' => $mark['total_marks_obtained'],
                            'marks_breakdown_data' => $mark['marks_breakdown_data'],
                        ]);
                    }


                    Notification::make()
                        ->title('Success')
                        ->body('Evaluation Result created successfully.')
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
