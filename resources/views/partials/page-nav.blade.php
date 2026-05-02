<header class="border-b border-slate-200/80 bg-white/95 backdrop-blur-md">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-3 px-4 py-3 sm:px-6">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 text-base font-semibold text-night-850">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-sky-500 to-night-700 text-white">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            {{ config('site.name') }}
        </a>
        <div class="flex min-w-0 flex-1 flex-nowrap items-center justify-end gap-3 md:gap-4">
            <nav class="hidden min-w-0 items-center gap-4 text-sm font-medium text-slate-600 md:flex lg:gap-6" aria-label="{{ __('site.nav.navigation') }}">
                <a href="{{ route('home') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.home') }}</a>
                <a href="{{ route('ticket.authenticate') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.authenticate_short') }}</a>
                <a href="{{ route('refund') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.refund') }}</a>
            </nav>
            @include('partials.language-switcher', ['variant' => 'nav'])
            <button
                type="button"
                id="pn-open"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-night-850 shadow-sm md:hidden"
                aria-label="{{ __('site.nav.open_menu') }}"
                aria-expanded="false"
                aria-controls="pn-drawer"
            >
                <span class="sr-only">{{ __('site.nav.menu') }}</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<div id="pn-backdrop" class="fixed inset-0 z-[60] hidden bg-night-950/40 backdrop-blur-[2px] md:hidden" aria-hidden="true"></div>
<aside
    id="pn-drawer"
    class="fixed inset-y-0 right-0 z-[70] flex h-screen w-[min(100%,22rem)] max-w-full translate-x-full flex-col bg-white shadow-2xl transition-transform duration-300 ease-out md:hidden"
    role="dialog"
    aria-modal="true"
    aria-labelledby="pn-title"
    aria-hidden="true"
>
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-4">
        <p id="pn-title" class="text-lg font-semibold text-night-900">{{ __('site.nav.navigation') }}</p>
        <button type="button" id="pn-close" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-night-900" aria-label="{{ __('site.nav.close_menu') }}">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <nav class="flex-1 overflow-y-auto px-4 py-4" aria-label="{{ __('site.nav.navigation') }}">
        <ul class="space-y-1">
            <li><a href="{{ route('home') }}" class="pn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.home') }}</a></li>
            <li><a href="{{ route('ticket.authenticate') }}" class="pn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.authenticate_ticket_long') }}</a></li>
            <li><a href="{{ route('refund') }}" class="pn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.refund') }}</a></li>
        </ul>
    </nav>
</aside>

@once
    @push('scripts')
    <script>
    (function () {
        var openBtn = document.getElementById('pn-open');
        var closeBtn = document.getElementById('pn-close');
        var backdrop = document.getElementById('pn-backdrop');
        var drawer = document.getElementById('pn-drawer');
        if (!openBtn || !closeBtn || !backdrop || !drawer) return;

        function openNav() {
            backdrop.classList.remove('hidden');
            drawer.classList.remove('translate-x-full');
            drawer.setAttribute('aria-hidden', 'false');
            backdrop.setAttribute('aria-hidden', 'false');
            openBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }
        function closeNav() {
            backdrop.classList.add('hidden');
            drawer.classList.add('translate-x-full');
            drawer.setAttribute('aria-hidden', 'true');
            backdrop.setAttribute('aria-hidden', 'true');
            openBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
            openBtn.focus();
        }
        openBtn.addEventListener('click', openNav);
        closeBtn.addEventListener('click', closeNav);
        backdrop.addEventListener('click', closeNav);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !backdrop.classList.contains('hidden')) closeNav();
        });
        drawer.querySelectorAll('.pn-link').forEach(function (a) {
            a.addEventListener('click', function () {
                window.setTimeout(closeNav, 300);
            });
        });
    })();
    </script>
    @endpush
@endonce
