<x-app-layout>
    <div class="py-12">
        <div class="grid md:grid-cols-3 gap-y-5">
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

    <div class="py-6 ">
        {{ $posts->links() }}
    </div>
</x-app-layout>
