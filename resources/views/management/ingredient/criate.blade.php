@extends('components.managementlayout')

@section('title', '配合登録')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection

@section('main')
    <p class="topic-font">ルセット管理</p>
    <table class="exel">
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
                <td></td>
                <td></td>
            </tr>
            {{-- </tbody> --}}
            @isset($none)
                <tr>
                    <form action="{{ route('cakes.ingredient.post') }}" method="post" class="criate">
                        @csrf
                        <td></td>
                        <td>
                            <input type="text" name="basic_amount" placeholder="〇〇型〇枚分" value="{{ old('basic_amount') }}"
                                class="">
                            @error('basic_amount')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="ingredient_unit" placeholder="g/kgなど、共通のもの"
                                value="{{ old('ingredient_unit') }}">
                            @error('ingredient_unit')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td class="flex-row">
                            <select name="cake_infos_id" id="">
                                <option value="">選択してください▼</option>
                                @forelse ($menus as $info)
                                    <option value="{{ $info->id }}" class="form-wrap-font">{{ $info->cakename }}</option>
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
                        <td></td>
                    </form>
                </tr>
            @endisset
            @isset($basic)
                <tr>
                    <form action="{{ route('cakes.ingredient.post') }}" method="post"class="criate">
                        @csrf
                        <td></td>
                        <td>
                            <input type="text" name="basic_amount" placeholder="〇〇型〇枚分" value="{{ old('basic_amount') }}"
                                class="">
                            @error('basic_amount')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="ingredient_unit" placeholder="g/kgなど、共通のもの"
                                value="{{ old('ingredient_unit') }}" class="">
                            @error('ingredient_unit')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                        <td class="cakeselect">
                            <select name="cake_infos_id" id="" class="cakeselect">
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
                        <td></td>
                        <td></td>
                    </form>
                </tr>
                @foreach ($basic as $item)
                    <tr>
                        <form action="{{ route('cakes.ingredient.update', $item->id) }}" method="post" class="update">
                            @csrf
                            @method('PATCH')
                            <td></td>
                            <td>
                                <input type="text" name="basic_amount" placeholder="{{ old('basic_amount') }}"
                                    class="" value="{{ $item->basic_amount }}">
                                @error('basic_amount')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="ingredient_unit" placeholder="{{ old('ingredient_unit') }}"
                                    class="" value="{{ $item->ingredient_unit }}">
                                @error('ingredient_unit')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <p class="">{{ $item->cake_info->cakename }}</p>
                                <input type="hidden" name="cake_infos_id" value="{{ $item->cake_infos_id }}">
                            </td>
                            <td>
                                <button class="form">更新</button>
                        </form>
                        </td>
                        <td>
                        <form action="{{ route('cakes.ingredient.destroy', $item) }}" method="post" class="delete">
                            @csrf
                            @method('DELETE')
                            <button>削除</button>
                        </form>

                        </td>
                        <td>
                            <div class="flex-column">
                                <a href="{{ route('cakes.ingredient.edit.store', $item) }}">配合詳細画面へ</a>
                                <a href="{{ route('cakes.ingredient.edit.order.store', $item) }}">発注試算画面へ</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>


@endsection
