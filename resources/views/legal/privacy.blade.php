@extends('layouts.page')

@section('title', __('site.meta.title_privacy', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_privacy', ['name' => config('site.name')]))

@section('page_content')
    @php($brand = config('site.name'))
    @php($brandStrong = '<strong class="text-night-900">'.e($brand).'</strong>')
    <h1 class="text-2xl font-bold text-night-900">{{ __('legal.privacy.title') }}</h1>
    <p class="mt-2 text-sm text-slate-500">{{ __('legal.privacy.updated', ['date' => __('legal.privacy.updated_date')]) }}</p>

    <div class="mt-8 space-y-8 text-sm leading-relaxed text-slate-700">
        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s1_h') }}</h2>
            <p class="mt-3">
                {!! __('legal.privacy.s1_p1', ['brand' => $brandStrong]) !!}
            </p>
            <p class="mt-3">{{ __('legal.privacy.s1_p2') }}</p>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s2_h') }}</h2>
            <h3 class="mt-4 text-sm font-semibold text-night-800">{{ __('legal.privacy.s2_1_h') }}</h3>
            <ul class="mt-2 list-inside list-disc space-y-1 pl-1">
                @foreach (__('legal.privacy.s2_1_li') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <h3 class="mt-4 text-sm font-semibold text-night-800">{{ __('legal.privacy.s2_2_h') }}</h3>
            <ul class="mt-2 list-inside list-disc space-y-1 pl-1">
                @foreach (__('legal.privacy.s2_2_li') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s3_h') }}</h2>
            <p class="mt-3">{{ __('legal.privacy.s3_intro') }}</p>
            <ul class="mt-2 list-inside list-disc space-y-1 pl-1">
                @foreach (__('legal.privacy.s3_li') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s4_h') }}</h2>
            <p class="mt-3">{{ __('legal.privacy.s4_intro') }}</p>
            <ul class="mt-2 list-inside list-disc space-y-1 pl-1">
                @foreach (__('legal.privacy.s4_li') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s5_h') }}</h2>
            <p class="mt-3">{{ __('legal.privacy.s5_p1') }}</p>
            <p class="mt-3">{{ __('legal.privacy.s5_p2') }}</p>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s6_h') }}</h2>
            <p class="mt-3">{{ __('legal.privacy.s6_p') }}</p>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s7_h') }}</h2>
            <p class="mt-3">{{ __('legal.privacy.s7_intro') }}</p>
            <ul class="mt-2 list-inside list-disc space-y-1 pl-1">
                @foreach (__('legal.privacy.s7_li') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s8_h') }}</h2>
            <h3 class="mt-4 text-sm font-semibold text-night-800">{{ __('legal.privacy.s8_1_h') }}</h3>
            <p class="mt-2">{{ __('legal.privacy.s8_1_p') }}</p>
            <h3 class="mt-4 text-sm font-semibold text-night-800">{{ __('legal.privacy.s8_2_h') }}</h3>
            <ul class="mt-2 list-inside list-disc space-y-1 pl-1">
                @foreach (__('legal.privacy.s8_2_li') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <h3 class="mt-4 text-sm font-semibold text-night-800">{{ __('legal.privacy.s8_3_h') }}</h3>
            <p class="mt-2">{{ __('legal.privacy.s8_3_p1') }}</p>
            <p class="mt-2">
                {{ __('legal.privacy.s8_3_p2') }}
                <a href="https://www.allaboutcookies.org/" class="font-medium text-sky-700 underline hover:text-night-850" rel="noopener noreferrer" target="_blank">{{ __('legal.privacy.cookies_site') }}</a>.
            </p>
        </section>

        <section>
            <h2 class="text-base font-semibold text-night-900">{{ __('legal.privacy.s9_h') }}</h2>
            <p class="mt-3">{{ __('legal.privacy.s9_p1') }}</p>
            <p class="mt-3">{{ __('legal.privacy.s9_p2') }}</p>
        </section>

        <p class="border-t border-slate-200 pt-6 text-sm text-slate-500">
            {{ __('legal.privacy.updated', ['date' => __('legal.privacy.updated_date')]) }}
        </p>

        <p class="text-sm">
            {{ __('legal.privacy.see_terms') }}
            <a href="{{ route('legal.terms') }}" class="font-medium text-sky-700 underline hover:text-night-850">{{ __('legal.privacy.terms_link') }}</a>.
        </p>
    </div>
@endsection
