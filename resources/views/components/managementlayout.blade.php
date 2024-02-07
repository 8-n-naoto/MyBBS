@include('include.header')
<main class="flex-row">
    @include('include.aside')
    <section>
        @yield('main')
    </section>
</main>
@yield('js')
@include('include.footer')
