@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('main')
    <section>
        <form method="POST" action="{{ route('reservations.date.get') }}">
            @csrf
            <label for="date" class="textbackground">
                <input type="date" name="date">日にちを選択してください
                <button>決定</button>
            </label>
        </form>

        <div>
            @include('include.reservations')
        </div>
    </section>
@endsection
