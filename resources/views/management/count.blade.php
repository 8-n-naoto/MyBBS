@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('main')
    <section>
        <h2 class="bigfont">{{ $name->cakename }}</h2>
        <div class="">
            @forelse ($infosubs as $info)
                <div class="textbackground">
                    @forelse ($reservations as $reservation)
                        @if ($info->main_reservation_id === $reservation->id)
                            <p class="smallfont">ご予約日：{{ $reservation->birthday }}</p>
                            <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
                            <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
                        @endif
                    @empty
                        <p>基本情報が足りていません</p>
                    @endforelse
                    <p class="smallfont">商品名：{{ $info->cakename }}</p>
                    <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                    <p class="smallfont">値段：{{ $info->price }}</p>
                    <p class="smallfont">メッセージ：{{ $info->massage }} </p>
                </div>
            @empty
                <p>準備中です</p>
            @endforelse
        </div>
    </section>
@endsection
