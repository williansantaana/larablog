<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid md:grid-cols-3 gap-y-5">
            @foreach($posts as $post)
                <x-post-card
                    id="{{ $post['id'] }}"
                    title="{{ $post['title'] }}"
                    cover="{{ $post['cover'] }}"
                    :category="$post['category']"
                    :tags="$post['tags']"
                />
            @endforeach
        </div>
    </div>

    <div class="py-6 ">
        {{ $posts->links() }}
    </div>

</x-app-layout>
