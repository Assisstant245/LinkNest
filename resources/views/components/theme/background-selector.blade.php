@props(['typeModel', 'valueModel', 'type', 'value', 'path' => null])

<div class="space-y-3">
    <x-ui.segmented class="w-full [&>*]:flex-1">
        @foreach(['solid' => 'Solid', 'gradient' => 'Gradient', 'image' => 'Image', 'pattern' => 'Pattern'] as $val => $labelText)
            <x-ui.segment name="theme-background-type" :value="$val" :active="$type === $val" wire:click="$set('{{ $typeModel }}', '{{ $val }}')">
                {{ $labelText }}
            </x-ui.segment>
        @endforeach
    </x-ui.segmented>

    @if(in_array($type, ['solid', 'gradient']))
        <label class="block">
            <p class="text-xs font-medium text-gray-600 mb-1.5">{{ $type === 'gradient' ? 'Gradient CSS' : 'Color' }}</p>
            <input type="text" wire:model.live="{{ $valueModel }}" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-300">
        </label>
    @elseif($type === 'image')
        @php $bgUrl = \App\Support\ImageProcessor::url($path); @endphp
        <div class="space-y-2">
            @if($bgUrl)
                <img src="{{ $bgUrl }}" class="w-full h-24 rounded-lg object-cover border border-gray-200">
            @endif
            <div class="flex items-center gap-2">
                <label class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 text-gray-700 hover:border-indigo-300 text-xs font-medium px-3 py-2 cursor-pointer transition-colors">
                    <x-ui.icon name="image" class="w-3.5 h-3.5" />
                    <span wire:loading.remove wire:target="backgroundImageUpload">{{ $bgUrl ? 'Replace' : 'Upload image' }}</span>
                    <span wire:loading wire:target="backgroundImageUpload">Uploading…</span>
                    <input type="file" wire:model="backgroundImageUpload" accept="image/png,image/jpeg,image/webp,image/gif" class="hidden">
                </label>
                @if($bgUrl)
                    <button type="button" wire:click="removeBackgroundImage"
                        class="shrink-0 w-8 h-8 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors" title="Remove">
                        <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                    </button>
                @endif
            </div>
            @error('backgroundImageUpload')
                <p class="text-[11px] text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @else
        <x-builder.blocks.placeholder :icon="'divider'" :label="ucfirst($type) . ' backgrounds — coming soon'" />
    @endif
</div>
