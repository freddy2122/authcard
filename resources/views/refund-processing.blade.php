@extends('layouts.app')

@section('title', __('site.forms.refund.processing_title').' — '.config('site.name'))
@section('meta_description', __('site.meta.desc_refund'))

@section('content')
    @include('partials.form-processing-screen', [
        'translationPrefix' => 'site.forms.refund',
        'redirectUrl' => route('refund'),
        'metaName' => 'refund-processing-redirect',
        'highlightNav' => 'refund',
    ])
@endsection
