@props(['messages'])

@if ($messages)
    <ul class="text-danger mt-4" {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li><small>{{ $message }}</small></li>
        @endforeach
    </ul>
@endif
