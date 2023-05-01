@php use Illuminate\Support\Facades\Storage; @endphp
@props(['id', 'title', 'content' => '', 'cover', 'category', 'tags'])

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <a href="{{ route('posts.get', ['id' => $id]) }}">
            <img class="w-full" src="{{ Storage::disk('public')->url($cover) }}" alt="{{ $title }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2 text-gray-900 dark:text-gray-100">
                    {{ $title }}
                </div>
                <div class="text-gray-900 dark:text-gray-100 text-base">
                    {!! substr(html_entity_decode($content), 0, 100) !!}
                    @if(!empty($content))
                        ...
                    @endif
                </div>
            </div>
            <div class="p-4 ">
            <span
                class="inline-block bg-gray-200 dark:bg-gray-900 rounded-full px-3 py-1 text-sm font-semibold text-gray-900 dark:text-gray-100  mr-2 mb-2">
                {{ $category['name'] }}
            </span>
            </div>
        </a>
    </div>
</div>
