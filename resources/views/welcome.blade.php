<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12">
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <a href="/staff"
                   class="scale-100 p-6 bg-white ring-1 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                    <div>
                        <div
                            class="h-16 w-16 bg-black/10 flex items-center justify-center rounded-full">
                            <x-heroicon-o-user class="stroke-black w-7 h-7"/>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Coordinator</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Login to your coordinator account to manage your staff and students.
                        </p>
                    </div>
                    <x-heroicon-o-arrow-right class="self-center shrink-0 stroke-black w-6 h-6 ml-auto"/>
                </a>

                <a href="/student"
                   class="scale-100 p-6 bg-white ring-1 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                    <div>
                        <div
                            class="h-16 w-16 bg-black/10 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                            <x-heroicon-o-academic-cap class="stroke-black w-7 h-7"/>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Student</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Login to your student account to create and start your FYP process.
                        </p>
                    </div>

                    <x-heroicon-o-arrow-right class="self-center shrink-0 stroke-black w-6 h-6 ml-auto"/>
                </a>

                <a href="/advisor"
                   class="scale-100 p-6 bg-white ring-1 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                    <div>
                        <div
                            class="h-16 w-16 bg-black/10 flex items-center justify-center rounded-full">
                            <x-heroicon-o-users class="stroke-black w-7 h-7"/>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Advisor</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Login to your advisor account to view your students' projects.
                        </p>
                    </div>

                    <x-heroicon-o-arrow-right class="self-center shrink-0 stroke-black w-6 h-6 ml-auto"/>
                </a>

                <a href="#/evaluators"
                   class="scale-100 p-6 bg-white ring-1 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                    <div>
                        <div
                            class="h-16 w-16 bg-black/10 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                            <x-heroicon-o-user-group class="stroke-black w-7 h-7"/>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Evaluation Panel</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Login to your evaluation panel account to evaluate students' projects.
                        </p>
                    </div>
                    <x-heroicon-o-arrow-right class="self-center shrink-0 stroke-black w-6 h-6 ml-auto"/>
                </a>
            </div>
        </div>

        <div class="flex justify-center mt-16 px-0 sm:items-center">
            <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>
</body>
</html>
