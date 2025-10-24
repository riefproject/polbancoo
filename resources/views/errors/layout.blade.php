<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title') · KopSy-Campus</title>
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />
        @vite('resources/css/app.css')
    </head>
    <body
        class="tw-flex tw-min-h-screen tw-items-center tw-justify-center tw-bg-muted tw-p-6 tw-font-sans tw-antialiased tw-text-gray-900"
    >
        <div
            class="tw-w-full tw-max-w-2xl tw-rounded-[28px] tw-border tw-border-secondary/10 tw-bg-white tw-p-8 tw-shadow-2xl tw-shadow-black/10 sm:tw-p-12"
        >
            <header class="tw-mb-8 tw-flex tw-items-center tw-gap-4">
                <img src="{{ asset('img/logo.png') }}" class="tw-h-16 tw-w-16" alt="">
                <div class="tw-flex tw-flex-col tw-gap-1">
                    <p class="tw-text-base tw-font-semibold tw-text-secondary">
                        KopSy-Campus
                    </p>
                    <p class="tw-text-sm tw-text-secondary/70">
                        Koperasi Syariah Digital Polban
                    </p>
                </div>
            </header>

            <main class="tw-space-y-6">
                <p class="tw-text-5xl tw-font-semibold tw-text-primary sm:tw-text-6xl">
                    @yield('code')
                </p>
                <h1 class="tw-text-2xl tw-font-semibold tw-text-gray-900 sm:tw-text-3xl">
                    @yield('headline')
                </h1>
                <p class="tw-text-base tw-text-gray-600">@yield('message')</p>
                <div class="tw-flex tw-flex-wrap tw-gap-3">@yield('actions')</div>
            </main>
        </div>
    </body>
</html>
