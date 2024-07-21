@props(['name' => '', 'title' => '', 'default' => '', 'type' => 'text', 'class' => ''])

<div class="form-group">
    <label for="{{ $name }}">{!! $title !!}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control @error($name)is-invalid
    @enderror {{ $class }}" value="{{ old($name, $default) }}">
    @error($name)
        <small class="fst-italic text-danger">{{ $message }}</small>
    @enderror
</div>
