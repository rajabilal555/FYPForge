<?php

namespace App\Filament\Student\Pages;

use App\Actions\InviteProjectAdvisor;
use App\Models\Advisor;
use App\Models\Student;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class FindAdvisor extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.find-advisor';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Advisor::query()
                    ->with('projects')
                    ->addSelect('*')
                    ->addSelect(DB::raw('slots-(SELECT COUNT(*) FROM projects WHERE projects.advisor_id = advisors.id) as projects_count'))
            )
            ->paginated([12, 24, 42, 88, 'all'])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Tables\Columns\Layout\Grid::make(1)
                    ->schema([
                        Tables\Columns\TextColumn::make('name')
                            ->weight(FontWeight::Bold)
                            ->searchable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('available_slots')
                            ->label('Available Slots')
                            ->counts('projects')
                            ->sortable(['projects_count'])
                            ->html()
                            ->state(function (Advisor $record): string {
                                return '<b>Slots:</b> '.$record->available_slots.' / '.$record->slots;
                            })
                            ->label('Available Slots'),
                        Tables\Columns\Layout\Panel::make([
                            Tables\Columns\Layout\Split::make([
                                Tables\Columns\TextColumn::make('room_no')
                                    ->searchable()
                                    ->grow(0)
                                    ->icon('heroicon-m-building-office'),
                                Tables\Columns\TextColumn::make('email')
                                    ->searchable()
                                    ->icon('heroicon-m-envelope'),
                            ]),
                        ])->extraAttributes(['class' => 'mt-2']),
                        Tables\Columns\TextColumn::make('field_of_interests')
                            ->markdown()
                            ->prefix('**Fields of Interest:** '),
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('field_of_interests')
                    ->multiple()
                    ->options(fn (): array => Advisor::all()->groupBy('field_of_interests')->keys()->mapWithKeys(fn ($value, $key) => [$value => $value])->all())
                    ->query(fn (Builder $query, array $data): Builder => $query->whereJsonContains('field_of_interests', $data['values']))
                    ->label('Fields of Interest'),
            ], Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('invite')
                    ->hidden(function (Advisor $advisor) {
                        return Student::authUser()->project == null
                            || $advisor->projects->count() >= $advisor->slots;
                    })
                    ->icon('heroicon-o-envelope')
                    ->fillForm(function (): array {
                        $project = Student::authUser()->project;

                        return [
                            'project' => $project,
                            'members' => $project->students,
                            'files' => $project->files->pluck('name'),
                        ];
                    })
                    ->steps([
                        Step::make('Review Project')
                            ->description('Review your project details')
                            ->disabled()
                            ->schema([
                                TextInput::make('project.name')
                                    ->columnSpan(1),
                                TextInput::make('project.description')
                                    ->columnSpan(1),
                                Repeater::make('members')
                                    ->schema([
                                        TextInput::make('registration_no')->required(),
                                        TextInput::make('name')->required(),
                                    ])
                                    ->columns(2)
                                    ->disabled(),
                                Repeater::make('files')
                                    ->simple(TextInput::make('name')->label('File Name'))
                                    ->disabled()
                                    ->columns(1),
                            ])
                            ->columns(2),
                        Step::make('Send Invite')
                            ->description('Send the invite to the advisor with a message')
                            ->schema([
                                MarkdownEditor::make('message')
                                    ->required(),
                            ]),
                    ])
                    ->action(fn (Advisor $record, array $data) => InviteProjectAdvisor::make()->handle(Student::authUser()->project, $record->id, $data['message']))
                    ->modalHeading(fn (Advisor $record): string => 'Invite '.$record->name.' to your project')
                    ->label('Invite'),
            ]);
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->paginate($this->getTableRecordsPerPage() == 'all' ? $query->count() : $this->getTableRecordsPerPage());
    }
}
