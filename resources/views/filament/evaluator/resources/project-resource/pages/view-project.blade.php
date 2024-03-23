<x-filament-panels::page>
    <x-filament::section>
        <p class="{{ !filled($project->description) ?'text-gray-400' : ''}} break-words overflow-ellipsis">
            {{ \Illuminate\Mail\Markdown::parse($project->description ?? "No description") }}
        </p>
    </x-filament::section>
</x-filament-panels::page>
