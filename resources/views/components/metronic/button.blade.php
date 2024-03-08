@if ($isLink ?? false)
    <a href="{{ $href ?? '#' }}" class="btn btn-transparent-{{ $class ?? 'primary' }} font-weight-bold mr-2">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type ?? 'button' }}" class="btn btn-{{ $class ?? 'primary' }}">
        {{ $slot }}
    </button>
@endif


{{-- <x-combined-button class="primary">
    {{ __('Primary') }}
</x-combined-button>

<x-combined-button class="success" isLink=true href="/success">
    {{ __('Success') }}
</x-combined-button> --}}
