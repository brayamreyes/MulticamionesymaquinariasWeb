<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \Artesaos\SEOTools\Facades\SEOMeta::generate() !!}
        {!! \Artesaos\SEOTools\Facades\OpenGraph::generate() !!}
        {!! \Artesaos\SEOTools\Facades\TwitterCard::generate() !!}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $settings = new \App\Settings\GeneralSetting();
            $favicon = $settings->favicon;
        @endphp
        @if($favicon)
            <link rel="icon" type="image/png" href="{{url('storage/web/' . $favicon)}}">
        @endif

        @vite('resources/css/app.css')
        @livewireStyles
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1481VPYM9T"></script>
        <script>   window.dataLayer = window.dataLayer || [];   function gtag(){dataLayer.push(arguments);}   gtag('js', new Date());   gtag('config', 'G-1481VPYM9T'); </script>
    </head>
    <body class="antialiased {{(isset($class) ? $class ? 'is-home' : '' : '')}}">
        <div class="min-h-screen flex flex-col">
            <livewire:common.header/>
            <main class="flex-grow">
                {{ $slot }}
            </main>
            <livewire:common.footer/>
        </div>
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
