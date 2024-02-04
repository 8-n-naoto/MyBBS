@include('include.header')
<main class="flex-row">
    @yield('aside')
    <section class="flex-column front-main">
        @yield('main')
        @yield('map')
    </section>
    @yield('js')
</main>
@include('include.footer')
