@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-xs font-medium text-emerald-600']) }}>
        {{ $status }}
    </div>
@endif
