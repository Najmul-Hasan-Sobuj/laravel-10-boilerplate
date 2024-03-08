<div class="{{ $colSize ?? 'col-lg-6' }}">
    <input id="{{ $id }}" type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror"
        name="{{ $name }}{{ $type == 'file' && $multiple ? '[]' : '' }}" placeholder="{{ $placeholder }}"
        value="{{ old($name) }}" {{ $multiple ? 'multiple' : '' }} {{ $attributes }} />
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    @isset($hint)
        <small class="form-text text-muted">{{ $hint }}</small>
    @endisset
</div>

{{-- <x-input id="full_name" type="text" name="full_name" placeholder="Enter full name" hint="Please enter your full name"
    colSize="col-lg-8"></x-input> --}}
