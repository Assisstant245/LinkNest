<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-lg border border-indigo-600/50 bg-gradient-to-b from-indigo-500 to-indigo-600 px-4 py-2 text-lg font-medium text-white shadow-sm shadow-indigo-500/30 transition-colors duration-150 hover:from-indigo-400 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-40 disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>
