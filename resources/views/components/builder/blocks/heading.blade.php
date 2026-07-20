@props(['data'])

<h2
    class="font-bold text-center px-2 py-1.5"
    style="color: var(--token-text, #111827); font-family: var(--token-font, inherit); font-size: calc(var(--token-font-size, 15px) + 5px); letter-spacing: var(--token-letter-spacing, 0px); line-height: var(--token-line-height, 1.5);"
>{{ $data['text'] ?? 'Heading' }}</h2>
