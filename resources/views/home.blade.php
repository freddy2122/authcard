@extends('layouts.app')

@section('title', __('site.meta.title_home', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_home'))

@php
    $testimonials = array_map(function ($r) {
        $r['text'] = str_replace(':brand', config('site.name_short'), $r['text']);

        return $r;
    }, __('site.testimonials'));
@endphp

@section('content')
    {{-- Navigation --}}
    <header class="fixed inset-x-0 top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl shadow-soft">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-semibold tracking-tight text-night-850">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-night-700 text-white shadow-glow">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
                {{ config('site.name_short') }}
            </a>

            <div class="flex min-w-0 flex-1 flex-nowrap items-center justify-end gap-2 sm:gap-3 lg:gap-4 xl:gap-6">
                <nav class="hidden min-w-0 items-center gap-3 text-sm font-medium text-slate-600 lg:gap-4 xl:gap-6 2xl:gap-8 md:flex" aria-label="{{ __('site.nav.navigation') }}">
                    <a href="#presentation" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.presentation') }}</a>
                    <a href="#avantages" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.advantages') }}</a>
                    <a href="#pourquoi" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.why_us') }}</a>
                    <a href="#etapes" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.first_steps') }}</a>
                    <a href="#avis" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.reviews') }}</a>
                    <a href="{{ route('refund') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.refund') }}</a>
                </nav>
                @include('partials.language-switcher', ['variant' => 'nav'])
                <a href="{{ route('ticket.authenticate') }}" class="hidden shrink-0 whitespace-nowrap rounded-full bg-night-850 px-3 py-2 text-xs font-semibold text-white shadow-soft transition hover:bg-night-700 sm:inline-flex sm:px-4 sm:text-sm">
                    {{ __('site.nav.authenticate_ticket') }}
                </a>
                <button
                    type="button"
                    id="mn-open"
                    class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-night-850 shadow-sm transition hover:bg-slate-50 md:hidden"
                    aria-label="{{ __('site.nav.open_menu') }}"
                    aria-expanded="false"
                    aria-controls="mn-drawer"
                >
                    <span class="sr-only">{{ __('site.nav.menu') }}</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- Off-canvas navigation (mobile) --}}
    <div id="mn-backdrop" class="fixed inset-0 z-[60] hidden bg-night-950/40 backdrop-blur-[2px] md:hidden" aria-hidden="true"></div>
    <aside
        id="mn-drawer"
        class="fixed inset-y-0 right-0 z-[70] flex h-screen w-[min(100%,22rem)] max-w-full translate-x-full flex-col bg-white shadow-2xl transition-transform duration-300 ease-out md:hidden"
        role="dialog"
        aria-modal="true"
        aria-labelledby="mn-title"
        aria-hidden="true"
    >
        <div class="flex items-center justify-between border-b border-slate-200 px-4 py-4">
            <p id="mn-title" class="text-lg font-semibold text-night-900">{{ __('site.nav.navigation') }}</p>
            <button type="button" id="mn-close" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-night-900" aria-label="{{ __('site.nav.close_menu') }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 py-4" aria-label="{{ __('site.nav.navigation') }}">
            <ul class="space-y-1">
                <li><a href="#presentation" class="mn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.presentation') }}</a></li>
                <li><a href="#avantages" class="mn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.advantages') }}</a></li>
                <li><a href="#pourquoi" class="mn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.why_us') }}</a></li>
                <li><a href="#etapes" class="mn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.first_steps') }}</a></li>
                <li><a href="#avis" class="mn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.reviews') }}</a></li>
                <li><a href="{{ route('refund') }}" class="mn-link block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-night-900">{{ __('site.nav.refund') }}</a></li>
            </ul>
        </nav>
        <div class="border-t border-slate-200 p-4">
            <a href="{{ route('ticket.authenticate') }}" class="flex w-full items-center justify-center rounded-xl bg-night-850 py-3.5 text-sm font-semibold text-white shadow-lg hover:bg-night-700">
                {{ __('site.nav.authenticate_ticket') }}
            </a>
        </div>
    </aside>

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-200/60 bg-gradient-to-br from-sky-50 via-white to-frost-soft pt-28 pb-16 sm:pt-36 sm:pb-24">
        <div class="pointer-events-none absolute -right-20 top-10 h-72 w-72 rounded-full bg-sky-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -left-20 bottom-0 h-64 w-64 rounded-full bg-night-700/5 blur-3xl"></div>

        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                <div class="text-center lg:text-left">
                    <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-sky-200 bg-white/80 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-night-700 shadow-soft">
                        {{ __('site.hero.badge') }}
                    </p>
                    <h1 class="text-4xl font-bold tracking-tight text-night-900 sm:text-5xl">
                        {{ __('site.hero.title') }}
                        <span class="bg-gradient-to-r from-sky-600 to-night-700 bg-clip-text text-transparent"> {{ __('site.hero.title_gradient') }}</span>
                    </h1>
                    <p class="mt-6 text-lg leading-relaxed text-slate-600">
                        {{ __('site.hero.subtitle') }}
                    </p>
                    <div class="mt-10 flex flex-col items-center gap-4 sm:flex-row lg:justify-start">
                        <a id="verifier" href="{{ route('ticket.authenticate') }}" class="inline-flex w-full items-center justify-center rounded-full bg-night-850 px-8 py-3.5 text-base font-semibold text-white shadow-card transition hover:bg-night-700 sm:w-auto">
                            {{ __('site.hero.cta_primary') }}
                        </a>
                        <a href="{{ route('refund') }}" class="inline-flex w-full items-center justify-center rounded-full border-2 border-slate-200 bg-white px-8 py-3.5 text-base font-semibold text-night-850 transition hover:border-sky-300 hover:bg-sky-50 sm:w-auto">
                            {{ __('site.hero.cta_refund') }}
                        </a>
                    </div>
                </div>
                <div class="relative mx-auto max-w-lg lg:max-w-none">
                    <div class="relative overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-card ring-1 ring-slate-100">
                        <img
                            src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=80"
                            alt="{{ __('site.hero.img_alt') }}"
                            class="h-auto w-full object-cover"
                            width="900"
                            height="700"
                            loading="eager"
                            decoding="async"
                        >
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-night-900/90 via-night-900/40 to-transparent px-6 py-8">
                            <p class="text-sm font-medium text-white">{{ __('site.hero.caption_1') }}</p>
                            <p class="mt-1 text-xs text-sky-100/90">{{ __('site.hero.caption_2') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Où acheter --}}
    <section id="partenaires" class="border-y border-slate-200 bg-white py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-2xl font-bold text-night-900 sm:text-3xl">{{ __('site.partners.title') }}</h2>
            <p class="mx-auto mt-3 max-w-2xl text-center text-slate-600">
                {{ __('site.partners.intro', ['brand' => config('site.name_short')]) }}
            </p>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach (__('site.partners.cards') as $p)
                    <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-surface-muted shadow-soft transition hover:border-sky-200 hover:shadow-card">
                        <div class="aspect-[16/10] overflow-hidden">
                            <img src="{{ $p['img'] }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" decoding="async">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-night-900">{{ $p['name'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $p['desc'] }}</p>
                            <a href="{{ config('site.partner_ticket_url') }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex text-sm font-semibold text-sky-600 hover:text-night-850">
                                {{ __('site.partners.visit') }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Présentation + formulaire --}}
    <section id="presentation" class="py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-14 lg:grid-cols-2 lg:items-start">
                <div>
                    <div class="overflow-hidden rounded-3xl border border-slate-200 shadow-card">
                        <img
                            src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80"
                            alt="{{ __('site.presentation.img_alt') }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <h2 class="mt-10 text-3xl font-bold text-night-900 sm:text-4xl">{{ __('site.presentation.title') }}</h2>
                    <p class="mt-4 text-slate-600">
                        {{ __('site.presentation.lead') }}
                    </p>
                    <ul class="mt-8 space-y-4">
                        @foreach (__('site.presentation.bullets') as $item)
                            <li class="flex gap-4">
                                <span class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-sky-100 text-sky-700">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div>
                                    <p class="font-semibold text-night-900">{{ $item['t'] }}</p>
                                    <p class="text-sm text-slate-600">{{ $item['d'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div id="verifier-form" class="rounded-3xl border border-slate-200 bg-gradient-to-br from-white to-sky-50 p-8 shadow-card lg:sticky lg:top-28">
                    <h3 class="text-lg font-semibold text-night-900">{{ __('site.presentation.form_title') }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">
                        {{ __('site.presentation.form_text') }}
                    </p>
                    <a href="{{ route('ticket.authenticate') }}" class="mt-6 flex w-full items-center justify-center rounded-xl bg-[#4F70FF] py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-[#3d5ef5]">
                        {{ __('site.presentation.form_cta') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Avantages --}}
    <section id="avantages" class="border-t border-slate-200 bg-gradient-to-b from-slate-50 to-white py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-3xl font-bold text-night-900">{{ __('site.advantages.title') }}</h2>
            <p class="mx-auto mt-3 max-w-xl text-center text-slate-600">{{ __('site.advantages.lead') }}</p>
            <div class="mt-14 grid gap-10 md:grid-cols-3">
                @foreach (__('site.advantages.cards') as $idx => $b)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-soft">
                        <div class="mx-auto mb-5 h-24 w-24 overflow-hidden rounded-2xl ring-4 ring-sky-50">
                            @php
                                $advImgs = [
                                    'https://images.unsplash.com/photo-1501139083538-0139583c060f?auto=format&fit=crop&w=400&q=80',
                                    'https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=400&q=80',
                                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=400&q=80',
                                ];
                            @endphp
                            <img src="{{ $advImgs[$idx] ?? $advImgs[0] }}" alt="" class="h-full w-full object-cover" loading="lazy" decoding="async">
                        </div>
                        <h3 class="text-lg font-semibold text-night-900">{{ $b['t'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $b['d'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pourquoi nous --}}
    <section id="pourquoi" class="py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 overflow-hidden rounded-3xl border border-slate-200 bg-night-850 shadow-card lg:grid-cols-2">
                <div class="relative min-h-[280px] lg:min-h-full">
                    <img
                        src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=900&q=80"
                        alt="{{ __('site.why.img_alt') }}"
                        class="absolute inset-0 h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                    <div class="absolute inset-0 bg-gradient-to-r from-night-900/80 to-transparent lg:bg-gradient-to-t lg:from-night-900/70 lg:to-transparent"></div>
                </div>
                <div class="px-8 py-12 sm:px-12">
                    <h2 class="text-3xl font-bold text-white">{{ __('site.why.title', ['brand' => config('site.name_short')]) }}</h2>
                    <p class="mt-4 text-slate-300">
                        {{ __('site.why.lead') }}
                    </p>
                    <div class="mt-10 space-y-8">
                        @foreach (__('site.why.points') as $w)
                            <div>
                                <h3 class="font-semibold text-sky-300">{{ $w['t'] }}</h3>
                                <p class="mt-2 text-sm text-slate-400">{{ $w['d'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Étapes --}}
    <section id="etapes" class="border-t border-slate-200 bg-surface-muted py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-3xl font-bold text-night-900">{{ __('site.steps.title') }}</h2>
            <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (__('site.steps.items') as $step)
                    <div class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-sky-100 text-sm font-bold text-sky-800">{{ $step['n'] }}</span>
                        <h3 class="mt-4 font-semibold text-night-900">{{ $step['t'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $step['d'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Avis carousel --}}
    <section id="avis" class="border-t border-slate-200 bg-white py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-3xl font-bold text-night-900">{{ __('site.trust.title') }}</h2>
            <p class="mx-auto mt-3 max-w-xl text-center text-slate-600">{{ __('site.trust.subtitle', ['count' => count($testimonials)]) }}</p>

            @php
                $testimonialSlides = array_chunk($testimonials, 3);
            @endphp

            <div class="relative mx-auto mt-14 max-w-6xl">
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-b from-white to-sky-50/50 shadow-card">
                    <div id="t-track" class="flex transition-transform duration-500 ease-out will-change-transform">
                        @foreach ($testimonialSlides as $slide)
                            <div class="t-slide min-w-full shrink-0 px-4 py-8 sm:px-6 sm:py-10">
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($slide as $review)
                                        <article class="flex flex-col rounded-2xl border border-slate-100 bg-white/90 p-6 text-center shadow-soft">
                                            <img
                                                src="{{ $review['img'] }}"
                                                alt="{{ __('site.trust.portrait_alt', ['name' => $review['name']]) }}"
                                                class="mx-auto h-20 w-20 rounded-full object-cover shadow-md ring-4 ring-sky-50"
                                                width="80"
                                                height="80"
                                                loading="lazy"
                                                decoding="async"
                                            >
                                            <div class="mt-2 flex justify-center gap-0.5 text-amber-400" aria-hidden="true">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <span class="text-base">★</span>
                                                @endfor
                                            </div>
                                            <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-slate-700">
                                                {{ __('site.trust.quote_prefix') }}{{ $review['text'] }}{{ __('site.trust.quote_suffix') }}
                                            </blockquote>
                                            <footer class="mt-4 border-t border-slate-100 pt-4">
                                                <p class="font-semibold text-night-900">{{ $review['name'] }}</p>
                                                <p class="text-xs text-slate-500">{{ $review['role'] }}</p>
                                            </footer>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" id="t-prev" class="absolute left-0 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 translate-x-1 items-center justify-center rounded-full border border-slate-200 bg-white text-night-850 shadow-lg transition hover:bg-sky-50 sm:h-12 sm:w-12 lg:-translate-x-4" aria-label="{{ __('site.carousel.prev') }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" id="t-next" class="absolute right-0 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 -translate-x-1 items-center justify-center rounded-full border border-slate-200 bg-white text-night-850 shadow-lg transition hover:bg-sky-50 sm:h-12 sm:w-12 lg:translate-x-4" aria-label="{{ __('site.carousel.next') }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>

                <div
                    id="t-dots"
                    class="mt-8 flex flex-wrap justify-center gap-2"
                    data-dot-prefix="{{ __('site.carousel.dot_prefix') }}"
                    data-dot-suffix="{{ __('site.carousel.dot_suffix') }}"
                ></div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section id="remboursement" class="border-t border-slate-200 bg-gradient-to-r from-night-850 via-night-800 to-night-850 py-16 text-white">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold sm:text-3xl">{{ __('site.cta_bottom.title') }}</h2>
            <p class="mt-3 text-sky-100/90">{{ __('site.cta_bottom.subtitle') }}</p>
            <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('ticket.authenticate') }}" class="inline-flex justify-center rounded-full bg-white px-8 py-3 font-semibold text-night-850 shadow-lg hover:bg-sky-50">
                    {{ __('site.cta_bottom.btn_authenticate') }}
                </a>
                <a href="{{ route('refund') }}" class="inline-flex justify-center rounded-full border-2 border-white/40 px-8 py-3 font-semibold text-white hover:bg-white/10">
                    {{ __('site.cta_bottom.btn_refund') }}
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 bg-slate-50 py-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex justify-center md:justify-end">
                @include('partials.language-switcher', ['variant' => 'pill'])
            </div>
            <div class="grid gap-10 md:grid-cols-3">
                <div>
                    <p class="font-semibold text-night-900">{{ config('site.name') }}</p>
                    <p class="mt-2 text-sm text-slate-600">{{ __('site.footer.tagline') }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-night-800">{{ __('site.footer.quick_links') }}</p>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li><a href="#presentation" class="hover:text-sky-700">{{ __('site.nav.presentation') }}</a></li>
                        <li><a href="#avantages" class="hover:text-sky-700">{{ __('site.nav.advantages') }}</a></li>
                        <li><a href="{{ route('ticket.authenticate') }}" class="hover:text-sky-700">{{ __('site.nav.authenticate_ticket_long') }}</a></li>
                        <li><a href="{{ route('refund') }}" class="hover:text-sky-700">{{ __('site.nav.refund') }}</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold text-night-800">{{ __('site.footer.legal') }}</p>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li><a href="{{ route('legal.terms') }}" class="hover:text-sky-700">{{ __('site.footer.terms') }}</a></li>
                        <li><a href="{{ route('legal.privacy') }}" class="hover:text-sky-700">{{ __('site.footer.privacy') }}</a></li>
                        <li><a href="{{ route('legal.about') }}" class="hover:text-sky-700">{{ __('site.footer.about') }}</a></li>
                    </ul>
                </div>
            </div>

            <p class="mt-10 border-t border-slate-200 pt-8 text-center text-xs text-slate-500">
                {{ __('site.footer.copyright', ['name' => config('site.name')]) }}
            </p>
        </div>
    </footer>
@endsection

@push('scripts')
<script>
(function () {
    var openBtn = document.getElementById('mn-open');
    var closeBtn = document.getElementById('mn-close');
    var backdrop = document.getElementById('mn-backdrop');
    var drawer = document.getElementById('mn-drawer');
    if (!openBtn || !backdrop || !drawer) return;

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
    if (closeBtn) closeBtn.addEventListener('click', closeNav);
    backdrop.addEventListener('click', closeNav);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !backdrop.classList.contains('hidden')) closeNav();
    });
    drawer.querySelectorAll('.mn-link').forEach(function (a) {
        a.addEventListener('click', function () {
            window.setTimeout(closeNav, 350);
        });
    });
})();
</script>
<script>
(function () {
    var track = document.getElementById('t-track');
    var prev = document.getElementById('t-prev');
    var next = document.getElementById('t-next');
    var dotsWrap = document.getElementById('t-dots');
    if (!track || !prev || !next || !dotsWrap) return;

    var dotPrefix = dotsWrap.getAttribute('data-dot-prefix') || '';
    var dotSuffix = dotsWrap.getAttribute('data-dot-suffix') || '';
    var slides = track.querySelectorAll('.t-slide');
    var total = slides.length;
    var index = 0;
    var autoplay = null;

    function go(i) {
        index = ((i % total) + total) % total;
        track.style.transform = 'translateX(-' + (index * 100) + '%)';
        dotsWrap.querySelectorAll('[data-dot]').forEach(function (btn, n) {
            btn.classList.toggle('bg-night-850', n === index);
            btn.classList.toggle('bg-slate-300', n !== index);
            btn.setAttribute('aria-current', n === index ? 'true' : 'false');
        });
    }

    for (var d = 0; d < total; d++) {
        (function (n) {
            var b = document.createElement('button');
            b.type = 'button';
            b.setAttribute('data-dot', String(n));
            b.className = 'h-2.5 w-2.5 rounded-full bg-slate-300 transition sm:h-3 sm:w-3';
            b.setAttribute('aria-label', [dotPrefix, String(n + 1), dotSuffix].filter(Boolean).join(' ').trim());
            b.addEventListener('click', function () {
                go(n);
                resetAutoplay();
            });
            dotsWrap.appendChild(b);
        })(d);
    }

    prev.addEventListener('click', function () {
        go(index - 1);
        resetAutoplay();
    });
    next.addEventListener('click', function () {
        go(index + 1);
        resetAutoplay();
    });

    function resetAutoplay() {
        if (autoplay) clearInterval(autoplay);
        autoplay = setInterval(function () {
            go(index + 1);
        }, 6500);
    }

    go(0);
    resetAutoplay();

    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (reduced.matches && autoplay) {
        clearInterval(autoplay);
        autoplay = null;
    }
})();
</script>
@endpush
