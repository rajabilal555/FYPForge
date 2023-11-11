<x-filament-panels::page xmlns:x-filament="http://www.w3.org/1999/html">
    @if($this->project)
        <x-filament::section>
            <p>
                {{ $project->description }}
            </p>
        </x-filament::section>
        <div class="flex gap-4">
            <div class="w-2/6">
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

                        @foreach($project->invites as $invite)
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
                                        {{-- TODO: can cancel Invite --}}
                                        <p class="text-gray-400">Invited</p>
                                    </div>
                                </div>
                            </x-filament::section>
                        @endforeach

                    </div>

                    {{ $this->inviteStudentAction }}

                </x-filament::section>
            </div>

            <div class="w-2/6">
                <x-filament::section>
                    <x-slot name="heading">
                        Advisor
                    </x-slot>
                    @if($project->advisor == null)
                        <div class="text-gray-400">
                            No Advisor yet
                        </div>

                        {{ $this->inviteAdvisorAction }}
                    @else
                        {{ $project->advisor->name }}
                    @endif
                </x-filament::section>
            </div>

            <div class="w-2/6">
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
