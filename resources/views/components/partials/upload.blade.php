@props(['name' => '', 'title' => '', 'default' => ''])

<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <div class="uploads"></div>
    @error($name)
        <small class="fst-italic text-danger">{{ $message }}</small>
    @enderror
</div>
