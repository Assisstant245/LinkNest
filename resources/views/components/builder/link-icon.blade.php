@props(['name' => null])

@if ($name)
    @if (str_starts_with($name, 'lucide:'))
        <x-dynamic-component :component="'lucide-'.substr($name, 7)" {{ $attributes }} />
    @else
        <x-ui.icon :name="$name" {{ $attributes }} />
    @endif
@endif
