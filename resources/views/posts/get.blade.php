<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post['title'] }}
        </h2>
    </x-slot>

    <div class="mx-auto py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <img class="w-full" src="{{ Storage::disk('public')->url($post['cover']) }}" alt="{{ $post['title'] }}">
                <div class="px-6 py-4">
                    <div class="text-gray-900 dark:text-gray-100 text-base">
                        {!! html_entity_decode($post['content']) !!}
                    </div>
                </div>
                <div class="p-4 ">
                    @foreach($post['tags'] as $tag)
                        <span
                            class="inline-block bg-gray-200 dark:bg-gray-900 rounded-full px-3 py-1 text-sm font-semibold text-gray-900 dark:text-gray-100  mr-2 mb-2">
                        #{{ $tag['name'] }}
                    </span>
                    @endforeach
                </div>
                @auth
                    @if($post['user_id'] === Auth::user()->id)
                        <div class="p-4 flex items-center gap-4">
                            <x-link-button href="{{ route('posts.edit', $post['id']) }}" alt="Edit post '{{ $post['title'] }}'">
                                Edit
                            </x-link-button>
                            <form method="post" action="{{ route('posts.delete', $post['id']) }}">
                                @csrf
                                @method('delete')
                                <x-primary-button class="bg-red-800 dark:bg-red-700">{{ __('Delete') }}</x-primary-button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

</x-app-layout>
