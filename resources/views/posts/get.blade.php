<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post['title'] }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <img class="w-full" src="{{ Storage::disk('public')->url($post['cover']) }}" alt="{{ $post['title'] }}">
                <div class="px-6 py-4">
                    <div class="text-gray-900 dark:text-gray-100 text-base">
                        {!! html_entity_decode($post['content']) !!}
                    </div>
                </div>
                <div class="p-4 ">
            <span
                class="inline-block bg-gray-200 dark:bg-gray-900 rounded-full px-3 py-1 text-sm font-semibold text-gray-900 dark:text-gray-100  mr-2 mb-2">

            </span>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
