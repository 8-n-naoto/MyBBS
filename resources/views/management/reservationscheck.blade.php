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
                {{-- validationでnumber|null を追加する --}}
                <input type="text" name="MainReservationsID">-<input type="text" name="SubReservationsID">
                <button>検索</button>
            </label>
        </form>
        @isset($id)
            <h1 class="textbackground">予約番号{{ $id->MainReservationsID }}-{{ $id->SubReservationsID }}</h1>
            {{-- 検索結果出力箇所 --}}
            {{-- @include('include.reservations') --}}
            <div class="textbackground">
                @forelse ($reservations as $reservation)
                    <div class="textbackground">
                        <p class="smallfont">ご予約日：{{ $reservation->birthday }}
                        <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
                        <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
                        @forelse ($reservation->sub_reservations as $info)
                            <div class="textbackground">
                                <p class="smallfont">商品名：{{ $info->cakename }}</p>
                                <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                                <p class="smallfont"> 値段：{{ $info->price }}</p>
                                <p class="smallfont">メッセージ：{{ $info->message }} </p>
                                <form action="{{route('reservations.information.destroy',$info)}}" method="post" class="delete">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{$reservation->id}}">
                                    <button>削除</button>
                                </form>
                            </div>
                        @empty
                            <p>予約情報が不足しています</p>
                        @endforelse
                    </div>
                @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>
        @endisset
    </section>
    <script src="{{ url('js/button.js') }}"></script>
@endsection
