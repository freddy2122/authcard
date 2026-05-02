@extends('layouts.page')

@section('title', __('site.meta.title_about', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_about', ['name' => config('site.name')]))

@section('page_content')
    @php($brand = config('site.name'))
    @php($brandStrong = '<strong class="text-night-900">'.e($brand).'</strong>')
    <h1 class="text-3xl font-bold text-night-900">{{ __('legal.about.title') }}</h1>
    <p class="mt-4 text-lg leading-relaxed text-slate-600">
        {!! __('legal.about.lead', ['brand' => $brandStrong]) !!}
    </p>

    <div class="mt-12 space-y-12 text-sm leading-relaxed text-slate-700">
        <section>
            <h2 class="text-xl font-semibold text-night-900">{{ __('legal.about.mission_h') }}</h2>
            <div class="mt-4 space-y-4">
                <p>{!! __('legal.about.mission_p1', ['brand' => $brandStrong]) !!}</p>
                <p>{!! __('legal.about.mission_p2', ['brand' => $brandStrong]) !!}</p>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-night-900">{{ __('legal.about.expertise_h') }}</h2>
            <div class="mt-4 space-y-4">
                <p>{!! __('legal.about.expertise_p1', ['brand' => $brandStrong]) !!}</p>
                <p>{!! __('legal.about.expertise_p2', ['brand' => $brandStrong]) !!}</p>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-night-900">{{ __('legal.about.commitment_h') }}</h2>
            <div class="mt-4 space-y-4">
                <p>{!! __('legal.about.commitment_p1', ['brand' => $brandStrong]) !!}</p>
                <p>{!! __('legal.about.commitment_p2', ['brand' => $brandStrong]) !!}</p>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-night-900">{{ __('legal.about.vision_h') }}</h2>
            <div class="mt-4 space-y-4">
                <p>{!! __('legal.about.vision_p1', ['brand' => $brandStrong]) !!}</p>
                <p>{!! __('legal.about.vision_p2', ['brand' => $brandStrong]) !!}</p>
            </div>
        </section>
    </div>

    <p class="mt-12 border-t border-slate-200 pt-8 text-sm">
        <a href="{{ route('legal.terms') }}" class="font-medium text-sky-700 hover:text-night-850">{{ __('legal.about.link_terms') }}</a>
        <span class="mx-2 text-slate-300">·</span>
        <a href="{{ route('legal.privacy') }}" class="font-medium text-sky-700 hover:text-night-850">{{ __('legal.about.link_privacy') }}</a>
    </p>
@endsection
