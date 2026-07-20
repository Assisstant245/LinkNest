@props(['icon', 'label'])

<div
    class="flex flex-col items-center justify-center gap-2 py-8 opacity-60"
    style="border: 2px dashed var(--token-border, #d1d5db); border-radius: var(--token-card-radius, 12px); background: var(--token-surface, #f9fafb); color: var(--token-text, #9ca3af);"
>
    <x-ui.icon :name="$icon" class="w-6 h-6" />
    <span class="text-xs font-medium">{{ $label }}</span>
</div>
