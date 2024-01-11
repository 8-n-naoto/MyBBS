@extends('components.managementlayout')

@section('css')
<link rel="stylesheet" href="{{ url('css/font.css') }}">
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
            @include('include.reservations')
        @endisset
    </section>
@endsection
