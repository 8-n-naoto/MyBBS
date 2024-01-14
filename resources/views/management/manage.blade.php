@extends('components.managementlayout')

@section('css')
<link rel="stylesheet" href="{{ url('css/font.css') }}">
<link rel="stylesheet" href="{{ url('css/aside.css') }}">
<link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection

@section('main')
    <section>

        @include('include.calender')

        <div class="textbackground flex-coulumn">
            <p class="middlefont">{{ $day }}</p>
            @include('include.reservations')
        </div>

    </section>

    <script src="{{ url('js/calender.js') }}"></script>
@endsection
