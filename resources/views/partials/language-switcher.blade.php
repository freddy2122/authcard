@php
    $locales = config('site.locales', []);
    $flags = [
        'fr' => '🇫🇷',
        'en' => '🇬🇧',
        'es' => '🇪🇸',
        'pt' => '🇵🇹',
        'de' => '🇩🇪',
        'nl' => '🇳🇱',
        'it' => '🇮🇹',
    ];
    $current = app()->getLocale();
    $currentLabel = $locales[$current] ?? strtoupper($current);
    $currentFlag = $flags[$current] ?? '🌐';
    /** @var string $variant nav = même ligne/style que les liens du menu ; pill = encadré (footer optionnel) */
    $variant = $variant ?? 'nav';
    $isNav = $variant === 'nav';
@endphp
<details class="relative z-[60] shrink-0 open:[&_summary_.chevron]:rotate-180">
    <summary
        @class([
            'flex cursor-pointer list-none items-center gap-1.5 [&::-webkit-details-marker]:hidden',
            'rounded-md border-0 bg-transparent px-0 py-0 text-sm font-medium text-slate-600 shadow-none transition hover:text-night-850' => $isNav,
            'rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-medium text-night-850 shadow-sm transition hover:border-sky-200 hover:bg-sky-50/90' => ! $isNav,
        ])
        aria-label="{{ __('site.nav.choose_language') }}"
        aria-haspopup="listbox"
    >
        <span class="leading-none {{ $isNav ? 'text-base' : 'text-lg' }}" aria-hidden="true">{{ $currentFlag }}</span>
        <span class="{{ $isNav ? 'max-w-[10rem] truncate sm:max-w-[12rem]' : 'max-w-[9rem] truncate sm:max-w-none' }}">{{ $currentLabel }}</span>
        <svg
            class="chevron h-3.5 w-3.5 shrink-0 text-slate-400 transition-transform duration-200 sm:h-4 sm:w-4"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </summary>
    <div
        class="absolute right-0 top-[calc(100%+0.35rem)] z-[70] min-w-[13.5rem] overflow-hidden rounded-xl border border-slate-200/90 bg-white py-1 shadow-card ring-1 ring-slate-900/5"
        role="listbox"
        aria-label="{{ __('site.nav.choose_language') }}"
    >
        @foreach ($locales as $code => $label)
            @if ($code === $current)
                <span
                    class="flex cursor-default items-center gap-2.5 bg-sky-50 px-3 py-2.5 text-sm font-medium text-night-850"
                    role="option"
                    aria-selected="true"
                >
                    <span class="text-lg leading-none" aria-hidden="true">{{ $flags[$code] ?? '🌐' }}</span>
                    <span class="flex-1">{{ $label }}</span>
                    <svg class="h-4 w-4 shrink-0 text-sky-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @else
                <a
                    href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}"
                    hreflang="{{ $code }}"
                    rel="alternate"
                    class="flex items-center gap-2.5 px-3 py-2.5 text-sm text-slate-700 transition hover:bg-sky-50 hover:text-night-850"
                    role="option"
                >
                    <span class="text-lg leading-none" aria-hidden="true">{{ $flags[$code] ?? '🌐' }}</span>
                    <span>{{ $label }}</span>
                </a>
            @endif
        @endforeach
    </div>
</details>
