@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection

@section('main')
    <p class="textbackground bigfont">発注試算ツール</p>
    <h2 class="bigfont textbackground">ケーキの名前</h2>
    {{-- 検索フォーム --}}
    <form method="POST" action="{{ route() }}" class="textbackground ">
        @csrf
        <p>種類と期間を選択してください</p>
        <div>
            <p>商品を選択する</p>
            <select name="cake_id">
                @forelse ($collection as $item)
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
    </form>
    @isset($record)
        合計台数「〇〇」台
        <table>
            <thead>
                <tr>
                    <th>材料名</th>
                    <th>「基本量」分</th>
                    <th>ｇ/ｋｇなど</th>
                    <th>最低ロット分量</th>
                    <th>袋/ダースなど</th>
                    <th>計算結果</th>
                    <th>発注数</th>
                    <th>消費期限</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($collection as $item)
                    <tr>
                        <td>{{ $item->ingredient_name }}</td>
                        <td>{{ $item->ingredient_amount }}</td>
                        <td>{{ $item->basic_ingredient->ingredient_unit }}</td>
                        <td>{{ $item->lot_amount }}</td>
                        <td>{{ $item->basic_ingredient->ingredient_unit }}</td>
                        <td>計算結果 10個+10ｇとか</td>
                        <td>発注数 11個とか</td>
                        <td>{{ $item->expiration }}</td>
                    </tr>
                @empty
                    <p>必要な情報が不足しています</p>
                @endforelse
            </tbody>
        </table>
    @endisset
@endsection
