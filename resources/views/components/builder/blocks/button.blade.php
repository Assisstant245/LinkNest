@props(['data'])

<x-builder.link-button
    :label="$data['label'] ?? 'New link'"
    :subtitle="$data['subtitle'] ?? null"
    :icon="$data['icon'] ?? null"
    :variant="$data['variant'] ?? 'filled'"
    :thumbnail="$data['thumbnail'] ?? false"
    :featured="$data['featured'] ?? false"
    :button-bg="$data['buttonBg'] ?? null"
    :button-radius="$data['buttonRadius'] ?? null"
    :button-shadow="$data['buttonShadow'] ?? null"
/>
