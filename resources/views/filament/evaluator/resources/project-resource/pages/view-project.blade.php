<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="flex flex-col gap-4">
            <x-filament::section compact>
                <p class="{{ !filled($project->description) ? 'text-gray-400' : '' }} break-words overflow-ellipsis">
                    {{ \Illuminate\Mail\Markdown::parse($project->description ?? "No description") }}
                </p>
            </x-filament::section>
            <x-filament::section compact>
                <div class="flex flex-col gap-2">
                    <div>
                        @if($project->advisor == null)
                            <div class="text-gray-400">
                                No Advisor yet
                            </div>
                        @else
                            <span
                                class="font-semibold">Advisor:</span>  {{ $project->advisor->name }}
                        @endif
                    </div>
                    <div>
                        <span
                            class="font-semibold">Evaluation Date:</span> {{ $evaluationDate->toDayDateTimeString() }}
                        ({{ $evaluationDate->diffForHumans() }})
                    </div>
                    <div class="flex gap-2">
                         <span
                             class="font-semibold">Status:</span>
                        <x-filament::badge class="px-2" :size="\Filament\Support\Enums\ActionSize::Medium"
                                           :color="$project->status->getColor()">
                            {{ $project->status->getLabel() }}
                        </x-filament::badge>
                    </div>
                    <div class="flex gap-2">
                        <span
                            class="font-semibold">Approval Status:</span>
                        <x-filament::badge class="px-2" :size="\Filament\Support\Enums\ActionSize::Medium"
                                           :color="$project->approval_status->getColor()">
                            {{ $project->approval_status->getLabel() }}
                        </x-filament::badge>
                    </div>
                    <div class="flex gap-2">
                        <span
                            class="font-semibold">Term:</span>
                        <x-filament::badge class="px-2" :size="\Filament\Support\Enums\ActionSize::Medium"
                                           :color="$project->term->getColor()">
                            {{ $project->term->getLabel() }}
                        </x-filament::badge>
                    </div>
                    <div class="flex gap-2">
                        <span
                            class="font-semibold">Is Final Evaluation:</span>
                        <x-filament::badge class="px-2" :size="\Filament\Support\Enums\ActionSize::Medium"
                                           :color="$evaluationEvent->is_final_evaluation ? 'warning' : 'info'">
                            {{ $evaluationEvent->is_final_evaluation ? 'Yes' : 'No' }}
                        </x-filament::badge>
                    </div>
                </div>
            </x-filament::section>
            <x-filament::section compact>
                <x-slot name="heading">
                    Members
                </x-slot>
                <div class="flex flex-col gap-2">
                    @forelse($project->students as $student)
                        <x-filament::section compact>
                            <div class="flex justify-between items-center">
                                <div class="flex gap-4 items-center">
                                    <div class="flex flex-col gap-2 items-center">
                                        <x-heroicon-s-user class="w-6 h-6"/>
                                    </div>
                                    <div class="flex flex-col gap-2 justify-center">
                                        <h3 class="text-md">
                                            {{$student->name}}
                                        </h3>

                                    </div>
                                </div>
                            </div>
                        </x-filament::section>
                    @empty
                        <div class="text-gray-400">
                            No Members yet.
                        </div>
                    @endforelse
                </div>
            </x-filament::section>
            <x-filament::section compact>
                <x-slot name="heading">
                    Files
                </x-slot>
                <div class="flex flex-col gap-2">
                    @forelse($project->files as $file)
                        <x-filament::section compact>
                            <div class="flex justify-between items-center">
                                <div class="flex gap-4 items-center">
                                    <div class="flex flex-col gap-2 items-center">
                                        <x-heroicon-o-document class="w-6 h-6"/>
                                        <x-heroicon-o-clock class="w-4 h-4"/>
                                    </div>
                                    <div class="flex flex-col gap-2 justify-center">
                                        <h3 class="text-md">
                                            {{$file->name}}
                                        </h3>
                                        <p class="text-gray-400 text-sm">
                                            {{$file->created_at->diffForHumans()}} by {{$file->student->name}}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-4 items-center">
                                    {{ ($this->downloadFileAction)(['file' => $file->id]) }}
                                </div>
                            </div>
                        </x-filament::section>
                    @empty
                        <div class="text-gray-400">
                            No files yet.
                        </div>
                    @endforelse
                </div>
            </x-filament::section>
        </div>
        <div class="col-span-2">
            <x-filament::fieldset class="flex flex-col gap-4">
                <x-slot name="label">
                    Evaluation
                </x-slot>
                <div class="flex flex-col gap-2">
                    @forelse($project->students as $student)
                        <x-filament::section collapsible="true">
                            <x-slot name="heading">
                                <div class="flex gap-4 items-center">
                                    <div class="flex flex-col gap-2 items-center">
                                        <x-heroicon-s-user class="w-6 h-6"/>
                                    </div>
                                    <div class="flex flex-col gap-2 justify-center">
                                        <h3 class="text-md">
                                            {{$student->name}}
                                        </h3>
                                    </div>
                                </div>
                            </x-slot>
                            <div class="flex justify-between items-center">
                                <div class="flex gap-4 items-center">
                                    <div class="flex flex-col gap-2 justify-center">
                                        <p class="text-md">
                                            {{$this->getStudentMarks($student->id)??0}}<span
                                                class="mx-2 text-primary-400">/</span>{{$evaluationEvent->total_marks}}
                                        </p>
                                        <p>
                                            <span
                                                class="font-semibold">Remarks:</span> {{$this->getStudentRemarks($student->id) ?? 'No Remarks'}}
                                        </p>
                                    </div>
                                </div>
                                @if(!$submitted)
                                    <div class="flex gap-4 items-center">
                                        {{ ($this->editMarksAction)(['student' => $student->id]) }}
                                    </div>
                                @endif
                            </div>
                        </x-filament::section>
                    @empty
                        <div class="text-gray-400">
                            Project has no Members.
                        </div>
                    @endforelse
                </div>
                @if($project->students->count() > 0)
                    {{ $this->saveMarksAction }}
                @endif
            </x-filament::fieldset>
        </div>
    </div>


</x-filament-panels::page>
