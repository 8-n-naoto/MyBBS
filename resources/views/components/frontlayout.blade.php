@include('include.header')
<main class="flex-row">
    @yield('aside')
    <div class="flex-column front-main">
        @yield('main')
        @yield('map')
    </div>
    @yield('js')
</main>
@include('include.footer')
