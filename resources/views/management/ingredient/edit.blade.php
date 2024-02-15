@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/calender.css') }}">
@endsection
{{-- <?php dd($basic->id); ?> --}}
@section('main')
    <table>
        <thead>
            <tr>
                <th></th>
                <th>材料名</th>
                <th>分量({{ $basic->ingredient_unit }})</th>
                <th>最低ロット({{ $basic->ingredient_unit }})</th>
                <th>最低ロット(単位)</th>
                <th>賞味期限(日)</th>
                <th>処理ボタン</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>例</td>
                <td>バター</td>
                <td>500</td>
                <td>450</td>
                <td>袋、ダースなど</td>
                <td>約7日</td>
                <td>処理ボタン</td>
            </tr>
            <tr>
                <form action="{{ route('cakes.ingredient.edit.post', $basic) }}" method="post">
                    @csrf
                    <td>
                        <input type="hidden" name="basic_ingredients_id" value="{{ $basic->id }}">
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
                        <input type="text" name="lot_amount" class="cakeform">
                        @error('lot_amount')
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
                        <button>追加</button>
                    </td>
                </form>
            </tr>

            {{-- 既存の材料 --}}
            @forelse ($each as $item)
                <tr>
                    <form action="{{ route('cakes.ingredient.edit.update', $item) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <td></td>
                        <td>
                            {{ $item->ingredient_name }}
                            <input type="hidden" name="ingredient_name" value="{{ $item->ingredient_name }}">
                        </td>
                        <td>
                            <input type="text" name="ingredient_amount" value="{{ $item->ingredient_amount }}"
                                class="cakeform">
                        </td>
                        <td>
                            <input type="text" name="lot_amount" value="{{ $item->lot_amount }}" class="cakeform">

                        </td>
                        <td>
                            <input type="text" name="lot_unit" value="{{ $item->lot_unit }}" class="cakeform">
                        </td>
                        <td>
                            <input type="text" name="expiration" value="{{ $item->expiration }}" class="cakeform">
                        </td>
                        <td class="flex-row">
                            <input type="hidden" name="basic_ingredients_id" value="{{$basic->id}}">
                            <button>変更</button>
                        </td>
                    </form>
                    <td>
                        <form action="{{ route('cakes.ingredient.edit.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="basic_ingredients_id" value="{{$basic->id}}">
                            <button>削除</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td>登録されたものがありません</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
