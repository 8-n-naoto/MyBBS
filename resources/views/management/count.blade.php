@extends('components.managementlayout')

@section('title', '商品別予約数確認')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('main')
    <section>
        <p class="topic-font">商品別予約商品：{{ $cakeinfo->cakename }}</p>
        {{-- 検索フォーム --}}
        <form method="POST" action="{{ route('reservations.count.get', $cakeinfo) }}"  class="">
            @csrf
            <p class="form-font">期間を選択してください</p>
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
        <div>
            @isset($getcount)
                <p class="form-font">取得期間：{{ $startdate }}～{{ $enddate }}</p>
                <p class="form-font">合計予約数：{{ $count }}件</p>
                @include('include.reservations')
            @endisset
        </div>
    </section>
@endsection
