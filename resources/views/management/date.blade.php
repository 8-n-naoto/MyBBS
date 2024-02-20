@extends('components.managementlayout')

@section('title','日付別予約商品')

@section('css')
<link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('main')
    <p class="topic-font">日付別予約商品検索</p>
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
