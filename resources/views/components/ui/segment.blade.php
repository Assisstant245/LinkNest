@props(['active' => false, 'icon' => null, 'name' => 'segment', 'value' => null, 'type' => 'radio'])

<label
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center gap-1.5 rounded-md px-2.5 py-1.5 text-xs font-medium cursor-pointer transition-colors text-gray-500 hover:text-gray-800 has-[:checked]:bg-white has-[:checked]:text-gray-900 has-[:checked]:shadow-sm'
    ]) }}
>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" @checked($active) class="sr-only">
    @if($icon)
        <x-ui.icon :name="$icon" class="w-4 h-4" />
    @endif
    @isset($slot)
        @if(trim($slot))
            <span>{{ $slot }}</span>
        @endif
    @endisset
</label>
