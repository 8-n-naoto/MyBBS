@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('main')
    <section>
        {{-- 検索フォーム --}}
        <form method="POST" action="{{ route('reservations.information.get') }}">
            @csrf
            <p>予約番号を入力してください</p>
            <label class="textbackground flex-row">
                <input type="text" name="subID">
                <button>検索</button>
            </label>
        </form>
        @isset($id)
            <h1 class="textbackground">予約番号{{ $id->subID }}</h1>
            {{-- 検索結果出力箇所 --}}
            {{-- @include('include.reservations') --}}
            <div class="textbackground">
                @forelse ($reservations as $reservation)
                    <div class="textbackground">
                        <p class="smallfont">予約名：{{ $reservation->main_reservation->user->name }}様</p>
                        <p class="smallfont">受取日：{{ $reservation->main_reservation->birthday }}
                        <p class="smallfont">受け取り時間：{{ $reservation->main_reservation->time }}</p>
                        <p class="smallfont">商品名：{{ $reservation->cakename }}</p>
                        <p class="smallfont">大きさ：{{ $reservation->capacity }}</p>
                        <p class="smallfont"> 値段：{{ $reservation->price }}</p>
                        <p class="smallfont">メッセージ：{{ $reservation->message }} </p>
                        <form action="{{ route('reservations.information.destroy', $reservation) }}" method="post"
                            class="delete">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                            <button>削除</button>
                        </form>
                    </div>
                @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>
        @endisset
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
