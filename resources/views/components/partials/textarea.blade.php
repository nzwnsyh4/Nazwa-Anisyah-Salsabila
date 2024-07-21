@props(['name' => '', 'title' => '', 'default' => ''])

<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="2"
        class="form-control @error($name)is-invalid
    @enderror">{{ old($name, $default) }}</textarea>
    {{-- <input type="text" name="{{ $name }}" id="{{ $name }}"
        class="form-control @error($name)is-invalid
    @enderror" value="{{ old($name, $default) }}"> --}}
    @error($name)
        <small class="fst-italic text-danger">{{ $message }}</small>
    @enderror
</div>
