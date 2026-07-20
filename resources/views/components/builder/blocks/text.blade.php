@props(['data'])

<p
    class="text-center px-2 py-1.5 opacity-80"
    style="color: var(--token-text, #111827); font-family: var(--token-font, inherit); font-size: var(--token-font-size, 15px); letter-spacing: var(--token-letter-spacing, 0px); line-height: var(--token-line-height, 1.5);"
>{{ $data['text'] ?? '' }}</p>
