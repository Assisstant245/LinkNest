@props(['network' => 'link'])

@php
$icons = [
    'instagram' => 'instagram',
    'tiktok' => 'tiktok',
    'x-twitter' => 'x-twitter',
    'youtube' => 'youtube',
    'whatsapp' => 'whatsapp',
    'mail' => 'mail',
];
$icon = $icons[$network] ?? 'link';
@endphp

<a
    href="#"
    class="w-9 h-9 rounded-full shadow-sm flex items-center justify-center hover:-translate-y-0.5 transition-all duration-150 hover:[color:var(--token-primary,#4f46e5)]"
    style="background: var(--token-surface, #ffffff); border: 1px solid var(--token-border, #e5e7eb); color: var(--token-text, #374151);"
>
    <x-ui.icon :name="$icon" class="w-4 h-4" />
</a>
