<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SiteConfig::metadata(['title' => $title]) !!}
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,600" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('build/css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('build/js/app.js') }}" defer></script>

    <!-- Before the closing head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typesense-docsearch-css@0.4.1/dist/style.min.css">

</head>

<body class="antialiased scroll-smooth">
    <div x-data="{
        open: false,
        toggleMenu() {
            this.open = !this.open
            document.body.style.overflow = this.open ? 'hidden' : 'auto';
        },
        get headings() {
            return [...document.querySelectorAll('article h2, article h3')];
        },
        scrollY: 0,
        activeHeading: null,
        init() {
            this.scrollY = window.scrollY;
    
            this.$watch('scrollY', () => {
                let past = this.headings.filter(
                    (heading) => heading.offsetTop <= this.scrollY + window.innerHeight / 3,
                );
    
                this.activeHeading = past.length ? past[past.length - 1] : null;
            });
        },
        scrollTo(id) {
            console.log(id)
            let element = document.getElementById(id)
            element = element.parentElement ? element.parentElement : element
    
            console.log(element.offsetTop)
            window.scrollTo({
                top: element.offsetTop - 120,
                behavior: 'smooth',
            })
        }
    }" @scroll.window="scrollY = window.scrollY">

        <header class="container sticky top-0 z-40 flex h-screen max-h-screen flex-col" :class="{ 'h-screen': open }">
            <div class="h-18 block w-full flex-shrink-0 flex-grow-0">
                <nav class="relative w-full border-b bg-white px-4 py-2 sm:px-6 lg:px-8" x-ref="menu">
                    <!-- Primary Navigation Menu -->
                    <div class="px-4 lg:px-6">
                        <div class="flex h-14 justify-between">
                            <!-- Logo -->
                            <div class="flex flex-shrink-0 items-center">
                                <a href="/" class="flex items-center before:absolute before:inset-0 before:-left-[calc(90%-9rem)] before:w-full before:skew-x-[25deg] before:bg-stone-800">
                                    <img src="{{ asset('logo/' . config('site.logo')) }}" class="z-10 h-10 w-auto fill-current text-white">
                                </a>

                            </div>

                            <div class="flex w-full justify-end">
                                <div class="ml-10 flex w-full items-center justify-end">

                                    <x-language-switcher />

                                    <!-- Navigation Links -->
                                    <div class="ml-4 hidden items-center justify-end lg:flex">
                                        <div class="flex items-center space-x-2">

                                        </div>
                                    </div>
                                </div>

                                {{-- <div id="searchbar"></div> --}}

                            </div>


                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center lg:hidden">
                                <button @click="toggleMenu"
                                    class="inline-flex items-center justify-center p-2 text-stone-800 transition hover:text-stone-900 focus:text-stone-500 focus:outline-none">
                                    <span :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex">
                                        <x-icons name="hamburger-menu" class="h-5 w-5" />
                                    </span>
                                    <span :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden">
                                        <x-icons name="cross-2" class="h-5 w-5" />
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>

            </div>
            <!-- Mobile Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }"
                class="h-full w-full flex-auto overflow-y-auto overflow-x-hidden bg-white px-4 hidden lg:px-12"
                x-cloak>
                <div class="docs_sidebar h-[calc(100vh-10rem)]">
                    {!! $index !!}
                </div>
            </div>

        </header>

        <div class="container mx-auto items-start gap-x-8 scroll-smooth px-4 py-4 sm:px-6 md:flex lg:px-8">
            <aside
                class="sticky top-24 hidden min-w-[280px] max-w-[280px] shrink-0 overflow-y-auto px-4 lg:block lg:px-6 xl:px-8">
                <nav id="indexed-nav" class="block lg:mt-4">
                    <div class="docs_sidebar h-[calc(100vh-10rem)]">
                        {!! $index !!}
                    </div>
                </nav>
            </aside>
            {{ $slot }}
        </div>
    </div>
    <!-- Before the closing body -->
    <script src="https://cdn.jsdelivr.net/npm/typesense-docsearch.js@3.4.1/dist/umd/index.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/json-query@2.2.2/index.min.js"></script>

    <script>
        let aside = document.querySelector('aside');
        let links = Array.from(aside.querySelectorAll(
            'a[href$="{{ parse_url(LaravelLocalization::getNonLocalizedURL(Request::getPathInfo()), PHP_URL_PATH) }}" i]'
            ));
        let lastLink = links[links.length - 1];
        aside.scrollTop = lastLink.offsetTop - 48;
    </script>
</body>

</html>
