@include('include.header')
<main class="flex-row">
    @include('include.aside')
    <section class="background">
        @yield('main')
    </section>
</main>
@yield('js')
@include('include.footer')
