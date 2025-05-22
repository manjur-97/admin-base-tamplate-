<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document Title</title>

    @stack('styles')
</head>

<body>

    <header>
        @if($cms_header)
            @include('cms.layout.header.' . str_replace('.blade.php', '', $cms_header))
        @else
            @include('cms.layout.header.header_10')
        @endif
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @if($cms_footer)
            @include('cms.layout.footer.' . str_replace('.blade.php', '', $cms_footer))
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
