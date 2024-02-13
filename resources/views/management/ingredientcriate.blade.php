@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection

@section('main')
    <table>
        <thead>
            <tr>
                <th></th>
                <th>基本量</th>
                <th>単位(レシピの分量)</th>
                <th>ケーキの種類</th>
                <th>処理ボタン</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>例</td>
                <td></td>
                <td></td>
                <td>リストにして選んでもらう</td>
                <td>登録ボタン</td>
            </tr>
            @empty($record)
                <tr>
                    <td></td>
                    <td>
                        <input type="text" name="basic_amount" placeholder="〇〇型〇枚分" class="cakeform">
                        @error('basic_amount')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="ingredient_unit" placeholder="g/kgなど、共通のもの" class="cakeform">
                        @error('ingredient_unit')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        {{-- @forelse ($collection as $item) --}}
                        <input type="radio" name="cake_infos_id" value="">
                        @error('cake_infos_id')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        {{-- @empty --}}
                        <p>商品情報を作成してからご利用ください</p>
                        {{-- @endforelse --}}
                    </td>
                    <td>
                        <form action="" method="post">
                            @csrf
                            <button>登録</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="text" name="basic_amount" placeholder="前の情報" class="cakeform">
                        @error('basic_amount')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="ingredient_unit" placeholder="前の情報" class="cakeform">
                        @error('ingredient_unit')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <p>ケーキの名前（前の情報）</p>
                        <input type="hidden" name="cake_infos_id" value="前と同じもの">
                        @error('cake_infos_id')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <form action="" method="post">
                            @csrf
                            <button>更新・削除ボタン</button>
                        </form>
                    </td>
                </tr>
            @endempty
            @isset($record)
            @endisset
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>材料名</th>
                <th>分量</th>
                <th>単位</th>
                <th>最低ロット(分量)</th>
                <th>最低ロット(単位)</th>
                <th>賞味期限</th>
                <th>処理ボタン</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>例</td>
                <td>バター</td>
                <td>500</td>
                <td>ｇ</td>
                <td>450</td>
                <td>個</td>
                <td>約7日</td>
                <td>更新・削除ボタン</td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="basic_ingredients_id" value="basic_ingredients_idを入れる">
                    @error('basic_ingredients_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="ingredient_name" class="cakeform">
                    @error('ingredient_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="ingredient_amount" class="cakeform">
                    @error('ingredient_amount')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <p class="form-font">単位</p>
                    <input type="hidden" name="ingredient-unit">
                    @error('ingredient-unit')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="lot-amount" class="cakeform">
                    @error('lot-amount')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="lot_unit" class="cakeform">
                    @error('lot_unit')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="expiration" class="cakeform">
                    @error('expiration')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button>削除</button>
                    </form>
                    <p class="form-font">/</p>
                    <form action="" method="post">
                        @csrf
                        @method('PATCH')
                        <button>更新</button>
                    </form>
                </td>
            </tr>
            {{-- @forelse ($collection as $item)
                <tr>
                    <td></td>
                    <td>バター{{ $item->ingredient_name }}</td>
                    <td>500{{ $item->ingredient_amount }}</td>
                    <td>ｇ{{ $item->basic_ingredient->ingredient_unit }}</td>
                    <td>450{{ $item->lot_amount }}</td>
                    <td>個{{ $item->lot_unit }}</td>
                    <td>約7日「｛＄item->expiration｝」</td>
                    <td>
                        <form action="" method="post">
                            @csrf
                            <button>追加</button>
                        </form>
                    </td>
                </tr>

            @empty
                <p>登録してください</p>
            @endforelse --}}
        </tbody>
    </table>
@endsection
