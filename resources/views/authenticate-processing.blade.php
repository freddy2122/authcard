@extends('layouts.app')

@section('title', __('site.forms.authenticate.processing_title').' — '.config('site.name'))
@section('meta_description', __('site.meta.desc_authenticate'))

@section('content')
    @include('partials.form-processing-screen', [
        'translationPrefix' => 'site.forms.authenticate',
        'redirectUrl' => route('ticket.authenticate'),
        'metaName' => 'authenticate-processing-redirect',
        'highlightNav' => null,
    ])
@endsection
