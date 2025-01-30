<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('build/assets/css/app.css')}}">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-black overflow-hidden shadow-sm sm:rounded-lg welcome">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>    
</body>
</html>