@extends('components.managementlayout')

@section('css')
<link rel="stylesheet" href="{{ url('css/font.css') }}">
<link rel="stylesheet" href="{{ url('css/aside.css') }}">
<link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection

@section('main')
    <section>
        <div>
            <a href="/management/manage">
                <h2 class="bigfont textbackground">管理画面</h2>
            </a>
        </div>

        <div class="flex-row">
        @include('include.calender')

        <div class="textbackground flex-coulumn">
            <p class="middlefont">{{ $day }}</p>
            @include('include.reservations')
        </div>
    </section>
@endsection
