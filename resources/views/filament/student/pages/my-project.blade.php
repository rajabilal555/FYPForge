<x-filament-panels::page>
    @if($this->project)
        <x-filament::section>
            <p class="{{ !filled($project->description) ?'text-gray-400' : ''}} break-words overflow-ellipsis">
                {{ $project->description ?? "No description"}}
            </p>
        </x-filament::section>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-2/6">
                <x-filament::section>
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
                                                {{$invite->created_at->diffForHumans()}} by {{$invite->sender->name}}
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

                    {{ $this->inviteStudentAction }}

                </x-filament::section>
            </div>

            <div class="w-full md:w-2/6">
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

            <div class="w-full md:w-2/6">
                <x-filament::section>
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
