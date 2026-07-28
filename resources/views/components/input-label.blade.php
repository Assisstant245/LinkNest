@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-lg font-medium text-gray-600 mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
