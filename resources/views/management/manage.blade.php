@extends('components.managementlayout')

@section('title','管理画面')

@section('css')
<link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('js')
<script src="{{ url('js/calender.js') }}"></script>
@endsection

@section('main')
        <div>
            <a href="/management/manage">
                <h2 class="topic-font">管理画面</h2>
            </a>
        </div>

        <div class="flex-row">
        @include('include.calender')

        <div class="information-font">
            <p class="middlefont">{{ $day }}</p>
            @include('include.reservations')
        </div>
@endsection
