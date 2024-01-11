{{-- <?php dd($sub); ?> --}}

@extends('components.managementlayout')
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
            <h1>予約番号{{ $id->MainReservationsID }}-{{ $id->SubReservationsID }}</h1>
            @include('include.reservations')
        @endisset
        {{-- 検索結果出力箇所 --}}


    </section>
@endsection
