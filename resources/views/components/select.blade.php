@props(['name', 'default_option', 'options'])

<select name="{{ $name }}" {!! $attributes !!}>
    @if(!empty($default_option))
        <option value="">{{ $default_option }}</option>
    @endif
    @foreach($options as $option)
        <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
    @endforeach
</select>
