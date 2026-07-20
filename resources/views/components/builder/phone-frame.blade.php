@props(['backgroundStyle' => null])

<div id="phone-frame" class="relative mx-auto w-[300px] transition-[width] duration-300 ease-out" data-device="mobile">
    {{-- Side buttons --}}
    <span class="absolute -left-[3px] top-24 w-[3px] h-8 bg-gray-800 rounded-l-sm"></span>
    <span class="absolute -left-[3px] top-36 w-[3px] h-12 bg-gray-800 rounded-l-sm"></span>
    <span class="absolute -left-[3px] top-52 w-[3px] h-12 bg-gray-800 rounded-l-sm"></span>
    <span class="absolute -right-[3px] top-32 w-[3px] h-16 bg-gray-800 rounded-r-sm"></span>

    <div class="rounded-[2.75rem] bg-gray-900 p-3 shadow-2xl shadow-gray-900/30 ring-1 ring-black/10">
        <div class="relative rounded-[2rem] overflow-hidden bg-white h-[640px] flex flex-col">

            {{-- Dynamic island --}}
            <div class="absolute top-2.5 left-1/2 -translate-x-1/2 w-24 h-6 bg-gray-900 rounded-full z-20"></div>

            {{-- Status bar --}}
            <div class="relative z-10 flex items-center justify-between px-7 pt-3 pb-1 text-gray-900 shrink-0">
                <span class="text-xs font-semibold">9:41</span>
                <div class="flex items-center gap-1">
                    <x-ui.icon name="signal" class="w-3.5 h-3.5" />
                    <x-ui.icon name="wifi" class="w-3.5 h-3.5" />
                    <x-ui.icon name="battery" class="w-4 h-4" />
                </div>
            </div>

            {{-- Screen content --}}
            <div class="flex-1 overflow-y-auto" style="{{ $backgroundStyle ?? 'background: var(--token-page-bg, #f8fafc)' }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
