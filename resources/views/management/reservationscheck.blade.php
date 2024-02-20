@extends('components.managementlayout')

@section('title','予約情報検索')

@section('css')
<link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('main')
    <section>
        {{-- 検索フォーム --}}

        <p class="topic-font">予約情報検索</p>
        <form method="POST" action="{{ route('reservations.information.get') }}">
            @csrf
            <p class="form-font">予約番号を入力してください</p>
            <label class="textbackground flex-row">
                <input type="text" name="subID">
                <button>検索</button>
            </label>
        </form>
        
        @isset($id)
            <h1 class="form-font">予約番号{{ $id->subID }}</h1>
            {{-- 検索結果出力箇所 --}}
            {{-- @include('include.reservations') --}}
            <div class="textbackground">
                @forelse ($reservations as $reservation)
                    <div class="textbackground">
                        <p class="form-font">予約名：{{ $reservation->main_reservation->user->name }}様</p>
                        <p class="form-font">受取日：{{ $reservation->main_reservation->birthday }}
                        <p class="form-font">受け取り時間：{{ $reservation->main_reservation->time }}</p>
                        <p class="form-font">商品名：{{ $reservation->cakename }}</p>
                        <p class="form-font">大きさ：{{ $reservation->capacity }}</p>
                        <p class="form-font"> 値段：{{ $reservation->price }}</p>
                        <p class="form-font">メッセージ：{{ $reservation->message }} </p>
                        <form action="{{ route('reservations.information.destroy', $reservation) }}" method="post"
                            class="delete">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                            <button>削除</button>
                        </form>
                    </div>
                @empty
                    <p>ご予約がありません</p>
                @endforelse
            </div>
        @endisset
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
