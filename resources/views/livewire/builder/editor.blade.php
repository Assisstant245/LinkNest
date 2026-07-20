<div class="h-full flex flex-col">
    {{-- <pre style="background:#000;color:#0f0;padding:10px;font-size:11px;">{{ json_encode(collect($blocks)->map(fn($b) => ['id' => $b['id'], 'type' => $b['type'], 'label' => $b['data']['label'] ?? null]), JSON_PRETTY_PRINT) }}</pre> --}}

<x-builder.topbar
    :device="$device"
    :last-saved-at="$lastSavedAt"
    :is-published="$isPublished"
    :public-url="$publicUrl"
    :page-id="$pageId"
    :user-pages="$userPages"
/>
    <div class="flex-1 flex min-h-0">
        <x-builder.elements-panel
            :left-tab="$leftTab"
            :theme="$theme"
            :theme-presets="$themePresets"
            :active-preset-slug="$activePresetSlug"
            :upgrade-notice="$upgradeNotice"
        />

        <x-builder.canvas
            :blocks="$blocks"
            :selected-block-id="$selectedBlockId"
            :profile-name="$profileName"
            :profile-bio="$profileBio"
            :photo-url="$profilePhotoUrl"
            :theme="$theme"
            :device="$device"
            :social-links="$socialLinks"
            :selected-social-link-id="$selectedSocialLinkId"
            :available-social-networks="$availableSocialNetworks"
        />

        <x-builder.properties-panel
            :selected-block="$selectedBlock"
            :selected-index="$selectedIndex"
            :profile-name="$profileName"
            :profile-bio="$profileBio"
            :photo-url="$profilePhotoUrl"
            :selected-social-link="$selectedSocialLink"
            :selected-social-index="$selectedSocialIndex"
        />
    </div>
</div>