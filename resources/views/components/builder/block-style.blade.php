@props(['data' => []])

@php
$style = $data['style'] ?? [];

$shadowMap = [
    'none' => 'none',
    'soft' => '0 1px 3px rgba(0,0,0,0.08)',
    'strong' => '0 12px 28px rgba(0,0,0,0.18)',
    'glow' => '0 0 18px 2px var(--token-primary)',
];

$vars = [];

if (!empty($style['textColor'])) {
    $vars[] = "--token-text: {$style['textColor']}";
}

if (!empty($style['fontFamily'])) {
    $vars[] = "--token-font: '{$style['fontFamily']}', sans-serif";
}

if (!empty($style['fontSize'])) {
    $vars[] = "--token-font-size: {$style['fontSize']}px";
}

if (array_key_exists('radius', $style) && $style['radius'] !== null) {
    $vars[] = "--token-card-radius: {$style['radius']}px";
}

$direct = [];

if (!empty($style['bold']) || ($style['fontWeight'] ?? null) === 'bold') {
    $direct[] = 'font-weight: 700';
} elseif (($style['fontWeight'] ?? null) === 'medium') {
    $direct[] = 'font-weight: 500';
} elseif ($style['fontWeight'] ?? null) {
    $direct[] = 'font-weight: 400';
}

if (!empty($style['italic'])) {
    $direct[] = 'font-style: italic';
}

if (!empty($style['underline'])) {
    $direct[] = 'text-decoration: underline';
}

if (!empty($style['align'])) {
    $direct[] = "text-align: {$style['align']}";
}

if (isset($style['paddingV']) || isset($style['paddingH'])) {
    $direct[] = 'padding: '.($style['paddingV'] ?? 0).'px '.($style['paddingH'] ?? 0).'px';
}

if (isset($style['margin'])) {
    $direct[] = "margin: {$style['margin']}px";
}

if (isset($style['gap'])) {
    $direct[] = "margin-bottom: {$style['gap']}px";
}

if (!empty($style['shadow'])) {
    $direct[] = 'box-shadow: '.($shadowMap[$style['shadow']] ?? $shadowMap['none']);
}

if (!empty($style['background']['value'])) {
    $direct[] = 'background: '.$style['background']['value'];
}

$styleString = collect([...$vars, ...$direct])->implode('; ');
@endphp

<div @if($styleString) style="{{ $styleString }}" @endif>{{ $slot }}</div>
