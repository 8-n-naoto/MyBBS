@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('main')
    <section>
        <h2 class="bigfont textbackground">{{ $cakeinfo->cakename }}</h2>
        {{-- 検索フォーム --}}
        <form method="POST" action="{{ route('reservations.count.get', $cakeinfo) }}" class="textbackground ">
            @csrf
            <p>期間を選択してください</p>
            <div class="flex-row">
                <label for="stertdate">開始日
                    <input type="date" name="startdate" id="stertdate">
                </label>
                <label for="enddate">終了日
                    <input type="date" name="enddate" id="enddate">
                </label>
                <div>
                    <button>検索</button>
                </div>
            </div>
        </form>

        {{-- 子クラスから親クラスを出力したもの --}}
        <p class="form-font textbackground">合計予約数：{{ $count }}件</p>
        <div class="">
            @forelse ($reservations as $reservation)
                @isset($reservation->main_reservation->birthday)
                    <div class="textbackground">
                        <p class="smallfont">ご予約日：{{ $reservation->main_reservation->birthday }}</p>
                        <p class="smallfont">受け取り時間：{{ $reservation->main_reservation->time }}</p>
                        <p class="smallfont">予約名：{{ $reservation->main_reservation->user->name }}様</p>
                        <p class="smallfont">商品名：{{ $reservation->cakename }}</p>
                        <p class="smallfont">大きさ：{{ $reservation->capacity }}</p>
                        <p class="smallfont">値段：{{ $reservation->price }}</p>
                        <p class="smallfont">メッセージ：{{ $reservation->massage }} </p>
                    </div>
                @endisset
            @empty
                <p>準備中です</p>
            @endforelse

            @isset($getcount)
                @forelse ($reservations as $reservation)
                    <div class="textbackground">
                        <p class="smallfont">ご予約日：{{ $reservation->birthday }}
                        <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
                        <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
                        @forelse ($reservation->sub_reservations as $info)
                            <p class="smallfont">商品名：{{ $info->cakename }}</p>
                            <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                            <p class="smallfont"> 値段：{{ $info->price }}</p>
                            <p class="smallfont">メッセージ：{{ $info->massage }} </p>
                        @empty
                            <p>予約情報が不足しています</p>
                        @endforelse
                    </div>

                @empty
                    <p>予約がないよ！</p>
                @endforelse
            @endisset
        </div>


        {{-- <div class="">
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
        </div> --}}
    </section>
@endsection
