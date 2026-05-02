@extends('layouts.page')

@section('title', __('site.meta.title_terms', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_terms', ['name' => config('site.name')]))

@section('page_content')
    @php($brand = config('site.name'))
    @php($brandStrong = '<strong class="text-night-900">'.e($brand).'</strong>')
    <h1 class="text-2xl font-bold text-night-900">{{ __('legal.terms.title') }}</h1>

    <div class="mt-6 space-y-6 text-sm leading-relaxed text-slate-700">
        <p>
            {!! __('legal.terms.intro', ['brand' => $brandStrong]) !!}
        </p>

        @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] as $n)
            <section>
                <h2 class="text-base font-semibold text-night-900">{{ __('legal.terms.s'.$n.'_h') }}</h2>
                @if ($n === 7)
                    <p class="mt-2">
                        {{ __('legal.terms.s7_before') }}<a href="{{ route('legal.privacy') }}" class="font-medium text-sky-700 underline hover:text-night-850">{{ __('legal.terms.privacy_link') }}</a>{{ __('legal.terms.s7_after') }}
                    </p>
                @else
                    <p class="mt-2">
                        {!! __('legal.terms.s'.$n.'_p', ['brand' => e($brand)]) !!}
                    </p>
                @endif
            </section>
        @endforeach
    </div>
@endsection
