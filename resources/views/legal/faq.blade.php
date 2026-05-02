@extends('layouts.page')

@section('title', __('site.meta.title_faq', ['name' => config('site.name')]))
@section('meta_description', __('site.meta.desc_faq', ['name' => config('site.name')]))

@section('page_content')
    <h1 class="text-2xl font-bold text-night-900">{{ __('legal.faq.title') }}</h1>
    <dl class="mt-8 space-y-6 text-sm text-slate-700">
        <div>
            <dt class="font-semibold text-night-900">{{ __('legal.faq.q1') }}</dt>
            <dd class="mt-2 leading-relaxed">{{ __('legal.faq.a1') }}</dd>
        </div>
        <div>
            <dt class="font-semibold text-night-900">{{ __('legal.faq.q2') }}</dt>
            <dd class="mt-2 leading-relaxed">{{ __('legal.faq.a2') }}</dd>
        </div>
        <div>
            <dt class="font-semibold text-night-900">{{ __('legal.faq.q3') }}</dt>
            <dd class="mt-2 leading-relaxed">{{ __('legal.faq.a3') }}</dd>
        </div>
    </dl>
@endsection
