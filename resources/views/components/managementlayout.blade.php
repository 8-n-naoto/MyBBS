@include('include.header')
<main class="flex-row">
    @include('include.aside')
    <section class="informations">
        @yield('main')
    </section>
</main>
@yield('js')
<script src="{{ url('js/bootstrap.min.js') }}"></script>
@include('include.footer')
