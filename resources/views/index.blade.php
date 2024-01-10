@extends('components.frontlayout')
{{-- <?php dd($infos); ?> --}}

@section('main')
    <section>
        <h1 class="bigfont">デコレーションケーキ</h1>
        @include('include.cakes')
    </section>
    @include('include.google-map')
@endsection
