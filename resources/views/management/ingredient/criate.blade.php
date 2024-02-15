@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection
{{-- <?php dd($none); ?> --}}
@section('main')
    <table>
        <thead>
            <tr>
                <th></th>
                <th>基本量</th>
                <th>単位(レシピの分量)</th>
                <th>ケーキの種類</th>
                <th>処理ボタン</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>例</td>
                <td>〇〇型〇枚分</td>
                <td>g/kgなど、共通のもの</td>
                <td></td>
                <td></td>
            </tr>
            @isset($none)
                <form action="{{ route('cakes.ingredient.post') }}" method="post">
                    @csrf
                    <tr>
                        <td></td>
                        <td>
                            <input type="text" name="basic_amount" placeholder="〇〇型〇枚分" value="{{ old('basic_amount') }}"
                                class="cakeform">
                            @error('basic_amount')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="ingredient_unit" placeholder="g/kgなど、共通のもの"
                                value="{{ old('ingredient_unit') }}" class="cakeform">
                            @error('ingredient_unit')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td class="flex-row">
                            <select name="cake_infos_id" id="">
                                <option value="">選択してください▼</option>
                                @forelse ($menus as $info)
                                <option value="{{ $info->id }}">{{ $info->cakename }}</option>
                                    @error('cake_infos_id')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                @empty
                                    <p>商品情報を作成してからご利用ください</p>
                                @endforelse
                            </select>
                        </td>
                        <td>
                            <button>登録</button>
                        </td>
                    </tr>
                </form>
            @endisset
            @isset($basic)
                <tr>
                    <form action="{{ route('cakes.ingredient.post') }}" method="post">
                        @csrf
                        <td></td>
                        <td>
                            <input type="text" name="basic_amount" placeholder="〇〇型〇枚分" value="{{ old('basic_amount') }}"
                                class="cakeform">
                            @error('basic_amount')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="ingredient_unit" placeholder="g/kgなど、共通のもの"
                                value="{{ old('ingredient_unit') }}" class="cakeform">
                            @error('ingredient_unit')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td>
                            <select name="cake_infos_id" id="">
                                <option value="">選択してください▼</option>
                                @forelse ($cakeinfos as $info)
                                <option value="{{ $info->id }}">{{ $info->cakename }}</option>
                                    @error('cake_infos_id')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                @empty
                                    <p>商品情報を作成してからご利用ください</p>
                                @endforelse
                            </select>
                        </td>
                        <td>
                            <button>登録</button>
                        </td>
                    </form>
                </tr>
                @foreach ($basic as $item)
                    <tr>
                        <form action="{{ route('cakes.ingredient.update', $item->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <td></td>
                            <td>
                                <input type="text" name="basic_amount" placeholder="{{ old('basic_amount') }}"
                                    class="cakeform" value="{{ $item->basic_amount }}">
                                @error('basic_amount')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="ingredient_unit" placeholder="{{ old('ingredient_unit') }}"
                                    class="cakeform" value="{{ $item->ingredient_unit }}">
                                @error('ingredient_unit')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <p>{{ $item->cake_info->cakename }}</p>
                                <input type="hidden" name="cake_infos_id" value="{{ $item->cake_infos_id }}">
                                @error('cake_infos_id')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <button>更新する</button>
                            </td>
                        </form>
                        <td>
                            <form action="{{ route('cakes.ingredient.destroy', $item) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button>削除する</button>
                            </form>

                        </td>
                        <td class="flex-column">
                            <a href="{{ route('cakes.ingredient.edit.store', $item) }}">配合詳細画面へ</a>
                            <a href="{{ route('cakes.ingredient.edit.order.store', $item) }}">発注試算画面へ</a>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
@endsection
