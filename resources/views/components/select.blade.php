@props(['name', 'default_option', 'options', 'value' => ''])

<select name="{{ $name }}" {!! $attributes !!}>
    @if(!empty($default_option))
        <option value="">{{ $default_option }}</option>
    @endif
    @foreach($options as $option)
        <option
            value="{{ $option['id'] }}" @if($value == $option['id']) selected @endif>{{ $option['name'] }}</option>
    @endforeach
</select>
