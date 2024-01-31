@include('include.header')
<main class="flex-row">
    @yield('aside')
    <section class="flex-column front-main">
        @yield('main')
        @yield('map')
    </section>
</main>
@include('include.footer')
