<section>
    <form
        enctype="multipart/form-data"
        method="post"
        action="{{ route('posts.store') }}"
        class="mt-6 space-y-6"
    >
        @csrf

        <div>
            <x-input-label for="title" :value="__('Post Title')"/>
            <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" :value="old('name')"
                          autocomplete="title" required autofocus/>
            @error('title')
            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <div class="mt-2 block w-full">
                <x-input-label for="editor" :value="__('Post Content')"/>
                <textarea name="content" id="editor"></textarea>
                @error('content')
                <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <x-input-label for="cover" :value="__('Post Cover')"/>
            <x-text-input id="cover" name="cover" type="file" class="mt-2 block w-full" required/>
            @error('cover')
            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <x-input-label for="editor" :value="__('Post Category')"/>
            <x-select name="category_id" :options="$categories" class="mt-2 block" required/>
        </div>

        <div>
            <x-input-label for="editor" :value="__('Tags')" class="mb-2" />
            <x-multiple-select name="tags" class="block w-full"/>
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
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
