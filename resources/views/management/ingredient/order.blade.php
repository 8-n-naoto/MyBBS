@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection

@section('main')
    <p class="textbackground bigfont">発注試算ツール</p>
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
        <p class="form-font">基本量：{{ $basic->basic_amount }}</p>
        <p class="form-font" id="count"></p>
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

    <script>
        window.onload = function() {
            var tableElem = document.getElementById('exel_table');
            var rowElems = tableElem.rows;
            var exec = Number(prompt('何回仕込みますか？（数値のみで入力してください）'));
            for (i = 1, len = rowElems.length; i < len; i++) {
                //単位を先に取得
                //材料の単位
                var ingredient_unit = rowElems[i].cells[4].innerText;
                //ロットの単位
                var lot_unit = rowElems[i].cells[3].innerText;
                //計算結果（端数きり捨て）
                rowElems[i].cells[4].innerText =
                    `${rowElems[i].cells[1].innerText * exec % rowElems[i].cells[2].innerText}${rowElems[i].cells[4].innerText}`;
                //計算結果（余り算出）
                rowElems[i].cells[3].innerText =
                    `${parseInt(rowElems[i].cells[1].innerText * exec / rowElems[i].cells[2].innerText)}${rowElems[i].cells[3].innerText}`;

                //必要発注数
                //数値化する
                var n = Number(rowElems[i].cells[1].innerText * exec % rowElems[i].cells[2].innerText);
                if (n === 0) {
                    //無ければそのまま
                    rowElems[i].cells[5].innerText = rowElems[i].cells[3].innerText;
                } else {
                    //端数があれば発注数を+1する
                    rowElems[i].cells[5].innerText =
                        `${parseInt(Number(parseInt(rowElems[i].cells[1].innerText * exec / rowElems[i].cells[2].innerText)) + 1)}${lot_unit} `;
                }

                //その他単位つける必要があるもの
                //分量
                rowElems[i].cells[1].innerText = `${rowElems[i].cells[1].innerText}${ingredient_unit}`;
                //最低ロット分量
                rowElems[i].cells[2].innerText = `${rowElems[i].cells[2].innerText}${ingredient_unit}`;
            }
            document.getElementById('count').textContent = `：${exec}回分`;
        }
    </script>
@endsection
