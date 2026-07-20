@props(['name', 'solid' => false])

@php
$classes = $attributes->get('class', 'w-5 h-5');
@endphp

@switch($name)
    @case('undo')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M8 7 4 11l4 4"/><path d="M4 11h11a5 5 0 0 1 5 5v1"/></svg>
        @break
    @case('redo')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="m16 7 4 4-4 4"/><path d="M20 11H9a5 5 0 0 0-5 5v1"/></svg>
        @break
    @case('mobile')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="7" y="2.5" width="10" height="19" rx="2.5"/><path d="M11 18h2"/></svg>
        @break
    @case('tablet')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M11 18h2"/></svg>
        @break
    @case('desktop')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
        @break
    @case('save')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M5 4h11l3 3v13H5z"/><path d="M8 4v5h8V4M8 20v-6h8v6"/></svg>
        @break
    @case('eye')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z"/><circle cx="12" cy="12" r="2.75"/></svg>
        @break
    @case('rocket')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M12 2.5c3 1.5 5 4.8 5 9 0 2-1 4-1 4l-4 2-4-2s-1-2-1-4c0-4.2 2-7.5 5-9Z"/><circle cx="12" cy="10.5" r="1.5"/><path d="M9 15.5 6.5 18M15 15.5l2.5 2.5M8.5 21l1-2.5M15.5 21l-1-2.5"/></svg>
        @break
    @case('search')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><circle cx="11" cy="11" r="6.5"/><path d="m20 20-4.3-4.3"/></svg>
        @break
    @case('grip')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="{{ $classes }}"><circle cx="9" cy="6" r="1.3"/><circle cx="15" cy="6" r="1.3"/><circle cx="9" cy="12" r="1.3"/><circle cx="15" cy="12" r="1.3"/><circle cx="9" cy="18" r="1.3"/><circle cx="15" cy="18" r="1.3"/></svg>
        @break
    @case('text')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M5 6h14M12 6v13"/></svg>
        @break
    @case('heading')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M6 5v14M18 5v14M6 12h12"/></svg>
        @break
    @case('button')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="8.5" width="18" height="7" rx="3.5"/></svg>
        @break
    @case('social')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><circle cx="6" cy="12" r="2.5"/><circle cx="17.5" cy="5.5" r="2.5"/><circle cx="17.5" cy="18.5" r="2.5"/><path d="m8.2 10.8 7.1-4.2M8.2 13.2l7.1 4.2"/></svg>
        @break
    @case('image')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="4" width="18" height="16" rx="2.5"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="m4 17 5-5 3 3 4-4 4 4"/></svg>
        @break
    @case('video')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="5.5" width="13" height="13" rx="2.5"/><path d="m21 8.5-5 3.5 5 3.5v-7Z"/></svg>
        @break
    @case('divider')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="M4 12h16"/></svg>
        @break
    @case('contact')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="5" width="18" height="14" rx="2.5"/><circle cx="9" cy="10.5" r="2"/><path d="M6 16c0-1.7 1.3-3 3-3s3 1.3 3 3M14 9.5h4M14 13h4"/></svg>
        @break
    @case('spacer')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M12 3v18M8 7l4-4 4 4M8 17l4 4 4-4"/></svg>
        @break
    @case('chevron-down')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="m6 9 6 6 6-6"/></svg>
        @break
    @case('plus')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M12 5v14M5 12h14"/></svg>
        @break
    @case('trash')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M5 7h14M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2m1 0-.7 12a1.5 1.5 0 0 1-1.5 1.4H9.2a1.5 1.5 0 0 1-1.5-1.4L7 7"/></svg>
        @break
    @case('duplicate')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="8" y="8" width="12" height="12" rx="2"/><path d="M5.5 15.5H5a1.5 1.5 0 0 1-1.5-1.5V5A1.5 1.5 0 0 1 5 3.5h9A1.5 1.5 0 0 1 15.5 5v.5"/></svg>
        @break
    @case('swatch')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M4.5 4.5h8v8h-8z" transform="rotate(20 8.5 8.5)"/><path d="M13 13h7v7h-7z"/></svg>
        @break
    @case('typography')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M4 18 8.5 6h1L14 18M5.5 14h7"/><path d="M15.5 11a2.7 2.7 0 0 1 2.7-1.7c1.5 0 2.8 1 2.8 3v5.7M21 14.5c0 2-1.3 3.2-2.8 3.2s-2.5-.8-2.5-2.2c0-1.5 1.4-2.2 2.9-2.2.9 0 1.6.2 2.4.5"/></svg>
        @break
    @case('spacing')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="3" width="18" height="18" rx="2"/><rect x="7.5" y="7.5" width="9" height="9" rx="1"/></svg>
        @break
    @case('radius')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M4 20V10a6 6 0 0 1 6-6h10"/></svg>
        @break
    @case('shadow')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="4" y="4" width="12" height="12" rx="2"/><path d="M8 20h9a3 3 0 0 0 3-3V8" stroke-dasharray="2.5 3"/></svg>
        @break
    @case('background')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="3" width="18" height="18" rx="2.5"/><path d="M3 15.5 8 10l3.5 3.5L16 9l5 5.5" /><circle cx="8.5" cy="8" r="1.3" fill="currentColor" stroke="none"/></svg>
        @break
    @case('cursor')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="m5 3 5.5 15L12 12l6-1.5L5 3Z"/></svg>
        @break
    @case('align-left')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="M4 6h16M4 12h10M4 18h13"/></svg>
        @break
    @case('align-center')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="M4 6h16M7 12h10M5.5 18h13"/></svg>
        @break
    @case('align-right')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="M4 6h16M10 12h10M7 18h13"/></svg>
        @break
    @case('bold')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M7 5h6a3.5 3.5 0 0 1 0 7H7zM7 12h7a3.5 3.5 0 0 1 0 7H7z"/></svg>
        @break
    @case('italic')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="M10 5h7M7 19h7M13.5 5 10.5 19"/></svg>
        @break
    @case('underline')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="M6 4v7a6 6 0 0 0 12 0V4M5 20h14"/></svg>
        @break
    @case('link')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M9.5 14.5 14.5 9.5M8 17l-2 2a3.5 3.5 0 0 1-5-5l3-3a3.5 3.5 0 0 1 5-.2M16 7l2-2a3.5 3.5 0 0 1 5 5l-3 3a3.5 3.5 0 0 1-5 .2"/></svg>
        @break
    @case('mail')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="3" y="5" width="18" height="14" rx="2.5"/><path d="m4 6.5 8 6 8-6"/></svg>
        @break
    @case('instagram')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="{{ $classes }}"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r="1" fill="currentColor" stroke="none"/></svg>
        @break
    @case('tiktok')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="{{ $classes }}"><path d="M14 3h2.3c.3 1.8 1.5 3.2 3.7 3.5v2.4c-1.4 0-2.7-.4-3.8-1.2v6.6a5.4 5.4 0 1 1-4.8-5.4v2.5a2.9 2.9 0 1 0 2.6 2.9V3Z"/></svg>
        @break
    @case('x-twitter')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="{{ $classes }}"><path d="M4 4l7 8.5L4.3 20H6l5-5.8 4 5.8h4.7l-7.3-8.9L19.7 4H18l-4.6 5.3L9.7 4H4z"/></svg>
        @break
    @case('youtube')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round" class="{{ $classes }}"><rect x="2.5" y="6" width="19" height="12" rx="3.5"/><path d="M10.5 9.5 15 12l-4.5 2.5z" fill="currentColor" stroke="none"/></svg>
        @break
    @case('whatsapp')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="{{ $classes }}"><path d="M12 2.5a9.5 9.5 0 0 0-8.2 14.3L2.5 21.5l4.8-1.3A9.5 9.5 0 1 0 12 2.5Zm0 17.3a7.8 7.8 0 0 1-4-1.1l-.3-.2-2.8.8.8-2.7-.2-.3a7.8 7.8 0 1 1 6.5 3.5Zm4.3-5.8c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.5.1-.2.2-.6.8-.8 1-.1.2-.3.2-.5.1-.2-.1-1-.4-2-1.2-.7-.6-1.2-1.4-1.4-1.6-.1-.2 0-.4.1-.5l.4-.4c.1-.1.2-.3.2-.4.1-.1.1-.3 0-.4-.1-.1-.5-1.2-.7-1.7-.2-.4-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2.9 2.4c.1.2 1.6 2.5 4 3.4.6.2 1 .4 1.3.5.6.2 1.1.1 1.5.1.5-.1 1.4-.6 1.6-1.1.2-.5.2-1 .1-1.1-.1-.1-.2-.2-.4-.3Z"/></svg>
        @break
    @case('close')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" class="{{ $classes }}"><path d="m6 6 12 12M18 6 6 18"/></svg>
        @break
    @case('check')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="m5 12 5 5L19 7"/></svg>
        @break
    @case('lock')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
        @break
    @case('battery')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><rect x="2" y="8" width="18" height="8" rx="2"/><path d="M22 11v2" stroke-width="2"/><rect x="4" y="10" width="12" height="4" fill="currentColor" stroke="none"/></svg>
        @break
    @case('signal')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="{{ $classes }}"><rect x="2" y="14" width="3" height="6" rx="0.5"/><rect x="8" y="10" width="3" height="10" rx="0.5"/><rect x="14" y="6" width="3" height="14" rx="0.5"/><rect x="20" y="2" width="3" height="18" rx="0.5"/></svg>
        @break
    @case('wifi')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="{{ $classes }}"><path d="M4 9a13 13 0 0 1 16 0M7 12.5a8.5 8.5 0 0 1 10 0M10.2 16a4 4 0 0 1 3.6 0"/><circle cx="12" cy="19" r="1" fill="currentColor" stroke="none"/></svg>
        @break
    @default
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="{{ $classes }}"><circle cx="12" cy="12" r="9"/></svg>
@endswitch
