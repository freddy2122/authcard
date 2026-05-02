@extends('layouts.app')

@section('title', __('site.meta.title_authenticate', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_authenticate'))

@section('content')
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
                    <a href="{{ route('refund') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.refund') }}</a>
                </nav>
                @include('partials.language-switcher', ['variant' => 'nav'])
            </div>
        </div>
    </header>

    <div class="relative min-h-screen overflow-hidden bg-slate-100 pt-28 pb-16 sm:pt-32">
        <div class="pointer-events-none fixed inset-0 -z-0 flex items-center justify-center overflow-hidden" aria-hidden="true">
            <p class="max-w-[95vw] select-none text-center text-[11vw] font-bold uppercase leading-none tracking-tighter text-slate-300/50 sm:text-[8vw]">
                {{ config('site.watermark') }}
            </p>
        </div>

        <div class="relative z-10 mx-auto max-w-2xl px-4 sm:px-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-card sm:p-10">
                <h1 class="text-center text-2xl font-bold tracking-tight text-night-900 sm:text-3xl">
                    {{ __('site.forms.authenticate.title') }}
                </h1>
                <div class="mx-auto mt-4 h-1 w-20 rounded-full bg-gradient-to-r from-blue-500 via-indigo-500 to-pink-400"></div>
                <p class="mt-6 text-center text-sm leading-relaxed text-slate-600">
                    {{ __('site.forms.authenticate.intro') }}
                </p>

                @if (session('verification_error'))
                    <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900">
                        {{ session('verification_error') }}
                    </div>
                @endif

                <form class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2" action="{{ route('ticket.authenticate.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="md:col-span-1">
                        <label for="contact" class="block text-sm font-medium text-night-900">
                            {{ __('site.forms.authenticate.contact_label') }} <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="contact"
                            name="contact"
                            value="{{ old('contact') }}"
                            required
                            placeholder="{{ __('site.forms.authenticate.contact_placeholder') }}"
                            autocomplete="email"
                            class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 placeholder-slate-400 outline-none focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('contact') border-red-400 @enderror"
                        >
                        @error('contact')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-1">
                        <label for="amount" class="block text-sm font-medium text-night-900">
                            {{ __('site.forms.authenticate.amount_label') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="relative mt-2">
                            <select
                                id="amount"
                                name="amount"
                                required
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-night-900 outline-none focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('amount') border-red-400 @enderror"
                            >
                                <option value="" disabled @selected(old('amount') === null || old('amount') === '')>{{ __('site.forms.authenticate.select_amount') }}</option>
                                @foreach ($amounts as $value => $label)
                                    <option value="{{ $value }}" @selected(old('amount') === (string) $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-1">
                        <label for="card_type" class="block text-sm font-medium text-night-900">
                            {{ __('site.forms.authenticate.card_type_label') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="relative mt-2">
                            <select
                                id="card_type"
                                name="card_type"
                                required
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-night-900 outline-none focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('card_type') border-red-400 @enderror"
                            >
                                <option value="" disabled @selected(old('card_type') === null || old('card_type') === '')>{{ __('site.forms.authenticate.select_type') }}</option>
                                @foreach ($cardTypes as $value => $label)
                                    <option value="{{ $value }}" @selected(old('card_type') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </div>
                        @error('card_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-1">
                        <label for="code" class="block text-sm font-medium text-night-900">
                            {{ __('site.forms.authenticate.code_label') }} <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="code"
                            name="code"
                            value="{{ old('code') }}"
                            required
                            minlength="4"
                            maxlength="128"
                            autocomplete="off"
                            class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 placeholder-slate-400 outline-none focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('code') border-red-400 @enderror"
                            placeholder=""
                        >
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-start gap-3 md:col-span-2">
                        <input
                            type="checkbox"
                            id="hide_code"
                            name="hide_code"
                            value="1"
                            class="mt-1 h-4 w-4 rounded border-slate-300 text-[#4F70FF] focus:ring-[#4F70FF]"
                            @checked(old('hide_code'))
                        >
                        <label for="hide_code" class="text-sm text-slate-700">{{ __('site.forms.authenticate.hide_code') }}</label>
                    </div>

                    <div class="md:col-span-2">
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-[#4F70FF] py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-[#3d5ef5] focus:outline-none focus:ring-2 focus:ring-[#4F70FF] focus:ring-offset-2"
                        >
                            {{ __('site.forms.authenticate.submit') }}
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-slate-500">
                    <a href="{{ route('home') }}" class="font-medium text-sky-700 hover:text-night-850">{{ __('site.forms.authenticate.back_home') }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    var cb = document.getElementById('hide_code');
    var input = document.getElementById('code');
    if (!cb || !input) return;
    function sync() {
        input.type = cb.checked ? 'password' : 'text';
    }
    cb.addEventListener('change', sync);
    sync();
})();
</script>
@endpush
