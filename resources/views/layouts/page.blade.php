@extends('layouts.app')

@section('content')
    @include('partials.page-nav')
    <main class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        @yield('page_content')
    </main>
@endsection
