@extends('components.managementlayout')

@section('title', '発注試算シュミレーター')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('js')
    <script src="{{ url('js/exel.js') }}"></script>
@endsection

@section('main')
    <p class="topic-font">発注試算ツール</p>
    {{-- 検索フォーム --}}
    {{-- <form method="POST" action="" class="textbackground ">
        @csrf
        <p>種類と期間を選択してください</p>
        <div class="flex-row">
            <p>基本量を選択する</p>
            <select name="cake_id">
                @forelse ($cakeinfos as $item)
                    <option value="{{ $item->cake_infos_id }}">{{$item->cake_info->cakename}}</option>
                @empty
                    <p>商品を登録してください</p>
                @endforelse
            </select>
        </div>
        <div class="flex-row">
            <label for="stertdate">開始日</label>
            <input type="date" name="startdate" id="stertdate">
            <label for="enddate">終了日</label>
            <input type="date" name="enddate" id="enddate">
        </div>
        <div>
            <button>検索</button>
        </div>
    </form> --}}

    {{-- @isset($basic) --}}
    <div class="flex-row">
        <p class="middlefont">基本量：{{ $basic->basic_amount }}</p>
        <p class="middke" id="count"></p>
    </div>

    <table id="exel_table">
        <thead>
            <tr>
                <th>材料名</th>
                <th>分量({{ $basic->ingredient_unit }})</th>
                <th>最低ロット分量</th>
                <th>計算結果</th>
                <th>ロット未満分</th>
                <th>必要発注数</th>
                <th>消費期限</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($each as $item)
                <tr>
                    {{-- 材料名 --}}
                    <td>{{ $item->ingredient_name }}</td>
                    {{-- 材料の分量 --}}
                    <td>{{ $item->ingredient_amount }}</td>
                    {{-- 最低ロットｇ --}}
                    <td>{{ $item->lot_amount }}</td>
                    {{-- 計算結果 --}}
                    <td>{{ $item->lot_unit }}</td>
                    {{-- ロット未満分 --}}
                    <td>{{ $item->basic_ingredient->ingredient_unit }}</td>
                    {{-- 必要発注数 --}}
                    <td>{{ $item->basic_ingredient->ingredient_unit }}</td>
                    {{-- 消費期限 --}}
                    <td>{{ $item->expiration }}日</td>
                </tr>
            @empty
                <p>必要な情報が不足しています</p>
            @endforelse
        </tbody>
    </table>
    {{-- @endisset --}}
@endsection
