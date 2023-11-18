@props([
    'actions' => [],
    'breadcrumbs' => [],
    'heading',
    'project',
    'subheading' => null,
])

<header
    {{ $attributes->class(['fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between']) }}
>
    <div>
        @if ($breadcrumbs)
            <x-filament::breadcrumbs
                :breadcrumbs="$breadcrumbs"
                class="mb-2 hidden sm:block"
            />
        @endif
        <div class="flex gap-4">
            <h1
                class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl"
            >
                {{ $heading }}
            </h1>
            @if($project != null)
                <x-filament::badge class="px-4" :size="\Filament\Support\Enums\ActionSize::ExtraLarge"
                                   :color="$project->status->getColor()">
                    <p class="text-lg">
                        {{ $project->status->getLabel() }}
                    </p>
                </x-filament::badge>
            @endif
        </div>

        @if ($subheading)
            <p
                class="fi-header-subheading mt-2 max-w-2xl text-lg text-gray-600 dark:text-gray-400"
            >
                {{ $subheading }}
            </p>
        @endif
    </div>


    @if ($actions)
        <x-filament-actions::actions
            :actions="$actions"
            @class([
                'shrink-0',
                'sm:mt-7' => $breadcrumbs,
            ])
        />
    @endif
</header>
