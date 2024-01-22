@include('include.header')
<main class="flex-row">
    @yield('aside')
    <section class="flex-column">
        @yield('main')
        @yield('map')
    </section>
</main>
@include('include.footer')
