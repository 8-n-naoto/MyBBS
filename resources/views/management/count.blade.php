@extends('components.managementlayout')

@section('title','商品別予約数確認')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('main')
    <section>
        <p class="textbackground bigfont">商品別予約商品</p>
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
                        <p class="smallfont">値段：{{ $reservation->price }}円</p>
                        <p class="smallfont">メッセージ：{{ $reservation->message }} </p>
                    </div>
                @endisset
            @empty
                <p>準備中です</p>
            @endforelse

            @isset($getcount)
                @include('include.reservations')
            @endisset
        </div>
    </section>
@endsection
