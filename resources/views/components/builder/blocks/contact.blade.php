@props(['data' => []])

@php
    $email = $data['email'] ?? null;
    $phone = $data['phone'] ?? null;
@endphp

@if ($email || $phone)
    <div class="space-y-4">
        @if ($email)
            <x-builder.link-button label="Email" :subtitle="$email" icon="mail" variant="soft" />
        @endif
        @if ($phone)
            <x-builder.link-button label="Call" :subtitle="$phone" icon="lucide:phone" variant="soft" />
        @endif
    </div>
@else
    <x-builder.blocks.placeholder icon="contact" label="Add an email or phone number" />
@endif
