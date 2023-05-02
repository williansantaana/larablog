<section>
    <form
        enctype="multipart/form-data"
        method="post"
        action="{{ route('posts.update', $post['id']) }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('put')

        <div>
            <x-input-label for="title" :value="__('Post Title')"/>
            <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" :value="$post['title']"
                          autocomplete="title" required autofocus/>
            @error('title')
            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <div class="mt-2 block w-full">
                <x-input-label for="editor" :value="__('Post Content')"/>
                <textarea name="content" id="editor">{{ $post['content'] }}</textarea>
                @error('content')
                <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <x-input-label for="cover" :value="__('Post Cover')"/>
            <x-text-input id="cover" name="cover" type="file" class="mt-2 block w-full"/>
            @error('cover')
            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <x-input-label for="editor" :value="__('Post Category')"/>
            <x-select name="category_id" :options="$categories" class="mt-2 block" value="{{ $post['category_id'] }}" required/>
        </div>

        <div>
            <x-input-label for="editor" :value="__('Tags')" class="mb-2" />
            <x-multiple-select
                name="tags"
                class="block w-full"
                :values="implode(',', array_column($post['tags']->toArray(), 'name'))"
            />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-link-button href="{{ route('posts.show') }}" alt="Cancel">
                Cancel
            </x-link-button>
        </div>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</section>
