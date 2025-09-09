<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Dynamic SEO Tags --}}
    <title>{{ $website->title ?? 'My Portfolio' }}</title>
    <meta name="description" content="{{ $website->description ?? 'Explore my portfolio showcasing design, development, and project expertise.' }}">
    <meta name="keywords" content="{{ $website->keywords ?? 'portfolio, web developer, software engineer, Laravel developer, full stack developer' }}">
    <meta name="author" content="{{ $website->author ?? 'Manjur Rahman' }}">
    <meta name="robots" content="index, follow">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph (Facebook, LinkedIn, etc.) --}}
    <meta property="og:title" content="{{ $website->title ?? 'My Portfolio' }}">
    <meta property="og:description" content="{{ $website->description ?? 'Explore my portfolio showcasing design, development, and project expertise.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/portfolio-og.jpg') }}"> {{-- update this path --}}
    <meta property="og:type" content="website">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $website->title ?? 'My Portfolio' }}">
    <meta name="twitter:description" content="{{ $website->description ?? 'Explore my portfolio showcasing design, development, and project expertise.' }}">
    <meta name="twitter:image" content="{{ asset('images/portfolio-og.jpg') }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- External Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @stack('styles')
</head>


<body>

    <header>
        @if (!empty($cmsSetting->header))
            @include('cms.layout.header.dynamic.' . str_replace('.blade.php', '',$cmsSetting->header))
        @else
            @include('cms.layout.header.header_9')
        @endif
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @if (!empty($cmsSetting->footer))
            @include('cms.layout.footer.dynamic.' . str_replace('.blade.php', '', $cmsSetting->footer))
        @else
            @include('cms.layout.footer.footer_1')
        @endif
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.querySelector('button.md\\:hidden');
            const nav = document.querySelector('nav.hidden.md\\:flex');
            toggle?.addEventListener('click', () => {
                nav?.classList.toggle('hidden');
            });
        });
    </script>
    @stack('scripts')

</body>

</html>
