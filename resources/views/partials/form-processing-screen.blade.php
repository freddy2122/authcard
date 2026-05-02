{{--
    @var string $translationPrefix e.g. site.forms.authenticate / site.forms.refund (keys processing_*)
    @var string $redirectUrl URL après animation (route du formulaire)
    @var string $metaName nom unique de la balise meta pour le script
    @var string|null $highlightNav 'refund' pour mettre le lien remboursement en actif
--}}
@php
    $tp = $translationPrefix;
    $navRefundCurrent = ($highlightNav ?? null) === 'refund';
    $gid = substr(md5($metaName.'-svg'), 0, 10);
@endphp

@push('head')
    <meta name="{{ $metaName }}" content="{{ e($redirectUrl) }}">
    <style>
        @foreach (range(0, 11) as $i)
            [data-processing-dot="{{ $metaName }}-{{ $i }}"] {
                transform: translate(-50%, -50%) rotate({{ $i * 30 }}deg) translateY(-86px);
            }
        @endforeach
    </style>
@endpush

<header class="fixed inset-x-0 top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-md">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-3 px-4 py-3 sm:px-6">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 text-base font-semibold text-night-850">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-sky-500 to-night-700 text-white">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            {{ config('site.name_short') }}
        </a>
        <div class="flex min-w-0 flex-1 flex-nowrap items-center justify-end gap-3 md:gap-4">
            <nav class="flex min-w-0 items-center gap-4 text-sm font-medium text-slate-600 lg:gap-6" aria-label="{{ __('site.nav.navigation') }}">
                <a href="{{ route('home') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.home') }}</a>
                <a
                    href="{{ route('refund') }}"
                    class="whitespace-nowrap transition hover:text-night-850 {{ $navRefundCurrent ? 'font-semibold text-night-850' : '' }}"
                    @if ($navRefundCurrent) aria-current="page" @endif
                >{{ __('site.nav.refund') }}</a>
            </nav>
            @include('partials.language-switcher', ['variant' => 'nav'])
        </div>
    </div>
</header>

<div class="relative min-h-screen overflow-hidden bg-gradient-to-b from-night-900 via-night-850 to-night-950 pt-28 pb-12 sm:pt-32">
    <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -left-1/4 top-0 h-96 w-96 rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="absolute -right-1/4 bottom-0 h-96 w-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-lg px-4 sm:px-6">
        <div class="rounded-2xl border border-slate-200/60 bg-white p-6 shadow-card sm:p-10">
            <div class="flex flex-col items-center">
                <div class="relative mx-auto h-[200px] w-[200px] shrink-0">
                    <svg class="h-full w-full -rotate-90" viewBox="0 0 120 120" aria-hidden="true">
                        <defs>
                            <linearGradient id="processingRingGrad-{{ $gid }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#38bdf8" />
                                <stop offset="55%" stop-color="#0ea5e9" />
                                <stop offset="100%" stop-color="#818cf8" />
                            </linearGradient>
                            <filter id="processingGlow-{{ $gid }}" x="-40%" y="-40%" width="180%" height="180%">
                                <feGaussianBlur stdDeviation="1.5" result="b" />
                                <feMerge>
                                    <feMergeNode in="b" />
                                    <feMergeNode in="SourceGraphic" />
                                </feMerge>
                            </filter>
                        </defs>
                        <circle cx="60" cy="60" r="54" fill="none" stroke="#e2e8f0" stroke-width="5" />
                        <circle cx="60" cy="60" r="54" fill="none" stroke="#f1f5f9" stroke-width="2" stroke-dasharray="18 14" opacity="0.9" />
                        <circle
                            id="processing-ring-{{ $gid }}"
                            cx="60"
                            cy="60"
                            r="54"
                            fill="none"
                            stroke="url(#processingRingGrad-{{ $gid }})"
                            stroke-width="5"
                            stroke-linecap="round"
                            filter="url(#processingGlow-{{ $gid }})"
                            stroke-dasharray="339.292"
                            stroke-dashoffset="339.292"
                        />
                    </svg>
                    <div class="pointer-events-none absolute inset-0 flex items-center justify-center" aria-live="polite" aria-atomic="true">
                        <div class="flex h-[108px] w-[108px] flex-col items-center justify-center rounded-full bg-gradient-to-br from-sky-500 to-indigo-600 shadow-glow ring-4 ring-sky-400/25">
                            <span id="processing-pct-{{ $gid }}" class="text-3xl font-bold tabular-nums tracking-tight text-white drop-shadow-sm">0%</span>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute inset-0" aria-hidden="true">
                        @foreach (range(0, 11) as $i)
                            <span
                                class="processing-dot-{{ $gid }} absolute left-1/2 top-1/2 h-1.5 w-1.5 rounded-full bg-sky-300 opacity-0 shadow-glow"
                                data-processing-dot="{{ $metaName }}-{{ $i }}"
                            ></span>
                        @endforeach
                    </div>
                </div>

                <h1 class="mt-6 text-center text-2xl font-bold tracking-tight text-night-900 sm:text-3xl">
                    {{ __($tp.'.processing_title') }}
                </h1>
                <div class="mx-auto mt-3 h-1 w-20 rounded-full bg-gradient-to-r from-sky-500 via-indigo-500 to-pink-400"></div>
                <p class="mt-5 text-center text-sm leading-relaxed text-slate-600">
                    {{ __($tp.'.processing_p1') }}
                </p>
                <p class="mt-3 text-center text-sm leading-relaxed text-slate-600">
                    {{ __($tp.'.processing_p2') }}
                </p>

                <div class="mt-8 w-full rounded-xl border border-sky-200/80 border-l-4 border-l-sky-500 bg-slate-50/90 p-4 text-left">
                    <p class="text-sm font-semibold text-night-900">{{ __($tp.'.processing_label') }}</p>
                    <ul class="mt-3 space-y-2.5 text-sm processing-steps-{{ $gid }}" id="processing-steps-{{ $gid }}">
                        @foreach (range(1, 4) as $n)
                            <li class="processing-step flex items-start gap-2.5 text-slate-500" data-step="{{ $n }}">
                                <span class="processing-step-dot mt-1.5 h-2 w-2 shrink-0 rounded-full bg-slate-300 ring-2 ring-slate-200" aria-hidden="true"></span>
                                <span>{{ __($tp.'.processing_step_'.$n) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="mt-6 text-center text-xs leading-relaxed text-slate-500 sm:text-sm">
                    {{ __($tp.'.processing_notify') }}
                </p>

                <a
                    id="processing-back-{{ $gid }}"
                    href="{{ route('home') }}"
                    class="mt-6 inline-flex min-h-[44px] w-full max-w-sm items-center justify-center rounded-xl bg-sky-100 px-5 py-3 text-center text-sm font-semibold text-sky-900 opacity-50 pointer-events-none transition hover:bg-sky-200 sm:w-auto"
                >
                    {{ __($tp.'.processing_back') }}
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function () {
            var gid = "{{ $gid }}";
            var metaName = "{{ e($metaName) }}";
            var duration = 4800;
            var redirectMs = 5000;
            var redirectMeta = document.querySelector('meta[name="' + metaName + '"]');
            var redirectUrl = redirectMeta ? redirectMeta.getAttribute('content') || '/' : '/';
            var ring = document.getElementById('processing-ring-' + gid);
            var pctEl = document.getElementById('processing-pct-' + gid);
            var backBtn = document.getElementById('processing-back-' + gid);
            var circumference = 339.292;
            var dots = document.querySelectorAll('.processing-dot-' + gid);
            var steps = document.querySelectorAll('#processing-steps-' + gid + ' .processing-step');

            function easeOutCubic(t) {
                return 1 - Math.pow(1 - t, 3);
            }

            function setStepStates(p) {
                steps.forEach(function (row) {
                    var n = parseInt(row.getAttribute('data-step'), 10);
                    var dot = row.querySelector('.processing-step-dot');
                    var done = n < 4 ? p >= n * 25 : p >= 100;
                    var current = !done && p >= (n - 1) * 25;
                    row.classList.remove('text-slate-800', 'text-slate-500');
                    dot.classList.remove('bg-emerald-500', 'ring-emerald-200', 'bg-sky-500', 'ring-sky-300', 'animate-pulse', 'bg-slate-300', 'ring-slate-200');
                    if (done) {
                        row.classList.add('text-slate-800');
                        dot.classList.add('bg-emerald-500', 'ring-emerald-200', 'ring-2');
                    } else if (current) {
                        row.classList.add('text-slate-800');
                        dot.classList.add('bg-sky-500', 'ring-sky-300', 'ring-2', 'animate-pulse');
                    } else {
                        row.classList.add('text-slate-500');
                        dot.classList.add('bg-slate-300', 'ring-slate-200', 'ring-2');
                    }
                });
            }

            function tick(now, start) {
                var t = Math.min(1, (now - start) / duration);
                var eased = easeOutCubic(t);
                var p = Math.min(100, Math.round(eased * 100));
                var offset = circumference * (1 - eased);
                ring.setAttribute('stroke-dashoffset', String(offset));
                pctEl.textContent = p + '%';
                setStepStates(p);
                var showDots = Math.floor(eased * dots.length);
                dots.forEach(function (d, i) {
                    d.style.opacity = i < showDots ? String(0.45 + (i / dots.length) * 0.45) : '0';
                });
                if (t < 1) {
                    requestAnimationFrame(function (n) { tick(n, start); });
                } else {
                    pctEl.textContent = '100%';
                    setStepStates(100);
                    dots.forEach(function (d) { d.style.opacity = '0.85'; });
                    backBtn.classList.remove('opacity-50', 'pointer-events-none');
                    backBtn.classList.add('opacity-100');
                    setTimeout(function () {
                        window.location.href = redirectUrl;
                    }, redirectMs);
                }
            }

            requestAnimationFrame(function (now) { tick(now, now); });
        })();
    </script>
@endpush
