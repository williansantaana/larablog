<x-app-layout>
    <div class="py-12">
        <div class="grid grid-cols-4 gap-4">
            @foreach($posts as $post)
                <x-post-card
                    id="{{ $post['id'] }}"
                    title="{{ $post['title'] }}"
                    content="{{ $post['content'] }}"
                    cover="{{ $post['cover'] }}"
                    :category="$post['category']"
                    :tags="$post['tags']"
                />
            @endforeach
        </div>
    </div>
</x-app-layout>
