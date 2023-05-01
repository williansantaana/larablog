@props(['name'])
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

<select multiple name="{{ $name }}[]" {!! $attributes !!}></select>

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('select[name="{{ $name }}[]"]').select2({
            theme: "classic",
            tags: true
        });
    </script>
@endpush
