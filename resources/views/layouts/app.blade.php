<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', __('site.meta.desc_home'))">
    <title>@yield('title', __('site.meta.title_home', ['name' => config('site.name')]))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        night: {
                            950: '#030712',
                            900: '#0a1628',
                            850: '#0f2744',
                            800: '#152a45',
                            700: '#1e3a5f',
                            600: '#2d4a6f',
                        },
                        frost: {
                            DEFAULT: '#0ea5e9',
                            bright: '#0284c7',
                            dim: '#e0f2fe',
                            soft: '#f0f9ff',
                        },
                        surface: {
                            DEFAULT: '#ffffff',
                            muted: '#f8fafc',
                            subtle: '#f1f5f9',
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 6px -1px rgb(15 23 42 / 0.06), 0 2px 4px -2px rgb(15 23 42 / 0.06)',
                        'card': '0 20px 40px -15px rgb(15 39 68 / 0.12)',
                        'glow': '0 8px 30px -8px rgb(14 165 233 / 0.35)',
                    },
                },
            },
        };
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-slate-50 text-slate-700 antialiased font-sans selection:bg-frost-dim selection:text-night-900">
    @yield('content')
    @include('partials.back-to-top')
    @stack('scripts')
</body>
</html>
