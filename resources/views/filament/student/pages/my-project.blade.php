<x-filament-panels::page>
    @if($this->project)
        <x-filament::section>
            <p class="{{ !filled($project->description) ?'text-gray-400' : ''}} break-words overflow-ellipsis">
                {{ \Illuminate\Mail\Markdown::parse($project->description ?? "No description") }}
            </p>
        </x-filament::section>
        <div class="">
            <div class="columns-1 lg:columns-2 xl:columns-3 gap-4 space-y-4">
                <div class="break-inside-avoid-column">
                    <x-filament::section>
                        <x-slot name="heading">
                            <div class="flex flex-row justify-between">
                                Members
                                @if($project->isMemberLimitReached())
                                    <x-filament::badge color="warning" icon="heroicon-o-information-circle">
                                        Limit Reached
                                    </x-filament::badge>
                                @endif
                            </div>
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

                            @foreach($project->pendingMemberInvites as $invite)
                                <x-filament::section compact>
                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-4 items-center">
                                            <div class="flex flex-col gap-2 items-center">
                                                <x-heroicon-o-user class="w-6 h-6"/>
                                            </div>
                                            <div class="flex flex-col gap-2 justify-center">
                                                <h3 class="text-md">
                                                    {{$invite->student->name}}
                                                </h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{$invite->created_at->diffForHumans()}}
                                                    by {{$invite->sender->name}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex gap-4 items-center">
                                            <p class="text-gray-400">Invitation {{ $invite->status }}</p>
                                            {{ ($this->cancelMemberInviteAction)(['invite' => $invite->id]) }}
                                        </div>
                                    </div>
                                </x-filament::section>
                            @endforeach

                        </div>

                        @if(!$project->isMemberLimitReached())
                            {{ $this->inviteStudentAction }}
                        @endif


                    </x-filament::section>
                </div>

                <div class="break-inside-avoid-column">
                    <x-filament::section>
                        <x-slot name="heading">
                            Advisor
                        </x-slot>
                        @if($project->advisor == null)
                            @forelse($project->pendingAdvisorInvites as $invite)
                                <x-filament::section compact>
                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-4 items-center">
                                            <div class="flex flex-col gap-2 items-center">
                                                <x-heroicon-o-user class="w-6 h-6"/>
                                            </div>
                                            <div class="flex flex-col gap-2 justify-center">
                                                <h3 class="text-md">
                                                    {{$invite->advisor->name}}
                                                </h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{$invite->created_at->diffForHumans()}}
                                                    by {{$invite->sender->name}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex gap-4 items-center">
                                            <p class="text-gray-400">Invitation {{ $invite->status }}</p>
                                            {{ ($this->cancelAdvisorInviteAction)(['invite' => $invite->id]) }}
                                        </div>
                                    </div>
                                </x-filament::section>
                            @empty
                                <div class="text-gray-400">
                                    No Advisor yet
                                </div>
                            @endforelse
                            {{ $this->inviteAdvisorAction }}
                        @else
                            {{ $project->advisor->name }}
                        @endif
                    </x-filament::section>
                </div>

                <div class="break-inside-avoid-column">
                    <x-filament::section>
                        <x-slot name="heading">
                            Files
                        </x-slot>
                        <div class="flex flex-col gap-2">
                            @forelse($project->files as $file)
                                <x-filament::section compact>
                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-4 items-stretch">
                                            <div class="flex flex-col gap-2 justify-center">
                                                <h3 class="text-md flex gap-2">
                                                    <div class="w-6 flex justify-center items-center">
                                                        <x-file-type-icon :filetype="$file->getFileType()"
                                                                          class="w-6 h-6 text-gray-600"/>
                                                    </div>
                                                    {{$file->name}}
                                                </h3>
                                                <div class="text-gray-400 flex gap-2 text-sm items-center">
                                                    <div class="w-6 flex justify-center">
                                                        <x-heroicon-o-clock class="w-4 h-4 text-gray-600"/>
                                                    </div>
                                                    {{$file->created_at->diffForHumans()}} by {{$file->student->name}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-4 items-center">
                                            {{ ($this->downloadFileAction)(['file' => $file->id]) }}
                                            {{ ($this->deleteFileAction)(['file' => $file->id]) }}
                                        </div>
                                    </div>
                                </x-filament::section>
                            @empty
                                <div class="text-gray-400">
                                    No files yet.
                                </div>
                            @endforelse
                        </div>

                        {{ $this->uploadFileAction }}
                    </x-filament::section>
                </div>

                <div class="break-inside-avoid-column">
                    <x-filament::section>
                        <x-slot name="heading">
                            Queries
                        </x-slot>

                        <div class="flex flex-col gap-2">
                            @forelse($project->queries as $query)
                                <x-filament::section compact>
                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-4 items-center">
                                            <div class="flex flex-col gap-2 justify-center">
                                                <p class="text-asd">
                                                    {{ Str::limit( $query->query, 50, $end='...') }}
                                                </p>
                                                <p class="text-gray-400 text-sm">
                                                    {{ $query->created_at->diffForHumans()}}
                                                </p>
                                            </div>
                                        </div>
                                        {{ ($this->viewQueryAction)(['query' => $query->id]) }}
                                    </div>
                                </x-filament::section>
                            @empty
                                <div class="text-gray-400">
                                    You have no Queries.
                                </div>
                            @endforelse
                        </div>

                        {{ $this->sendQueryAction }}
                    </x-filament::section>
                </div>
                <div class="break-inside-avoid-column">
                    <x-filament::section>
                        <x-slot name="heading">
                            Tasks
                        </x-slot>

                        <div class="flex flex-col gap-2">
                            @forelse($project->tasks as $task)
                                <x-filament::section compact>
                                    <div class="pb-2 flex">
                                        <x-filament::badge :color="$task->status->getColor()">
                                            {{ $task->status->getLabel() }}
                                        </x-filament::badge>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-4 items-center">
                                            <div class="flex flex-col gap-2 justify-between">
                                                <p>
                                                    {{ $task->name }}
                                                </p>
                                                <div>
                                                    <p class="text-gray-400 text-sm">
                                                        Assigned on: {{ $task->created_at->diffForHumans()}}
                                                    </p>
                                                    <p class="text-gray-400 text-sm">
                                                        Due on: {{ $task->due_date?->diffForHumans() ?? 'No Due date' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{ ($this->viewTaskAction)(['task' => $task->id]) }}
                                    </div>
                                </x-filament::section>
                            @empty
                                <div class="text-gray-400">
                                    You have no Tasks.
                                </div>
                            @endforelse
                        </div>
                    </x-filament::section>
                </div>
            </div>
        </div>
    @else
        <x-filament::section>
            <x-slot name="heading">
                Whoops!
            </x-slot>

            You dont have a project yet. Create one now.
        </x-filament::section>
    @endif

</x-filament-panels::page>
