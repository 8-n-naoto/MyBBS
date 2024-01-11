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
            <div>
                <p class="smallfont textbackground">{{ $date }}</p>
                @forelse ($reservations as $reservation)
                    <div class="textbackground">
                        <p class="smallfont">ご予約日：{{ $reservation->birthday }}</p>
                        <p class="smallfont"> 受け取り時間：{{ $reservation->time }}</p>
                        <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
                        @forelse ($infosubs as $info)
                            @if ($reservation->id === $info->main_reservation_id)
                                <p class="smallfont">商品名：{{ $info->cakename }}</p>
                                <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                                <p class="smallfont">値段：{{ $info->price }}</p>
                                <p class="smallfont">メッセージ：{{ $info->massage }} </p>
                            @endif
                        @empty
                            <p>予約情報が不足しています</p>
                        @endforelse
                    </div>
                @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
