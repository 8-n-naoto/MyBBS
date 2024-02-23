@extends('components.managementlayout')

@section('title', '配合詳細')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection

{{-- <?php dd($basic->id); ?> --}}

@section('main')
    <table class="exel-edit">
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
                <td></td>
                <td></td>
            </tr>
            <tr id="addtr">
                <form action="{{ route('cakes.ingredient.edit.post', $basic) }}" method="post" class="criate">
                    @csrf
                    <td>
                        <input type="hidden" name="basic_ingredients_id" value="{{ $basic->id }}"
                            id="basic_ingredients_id">
                        @error('basic_ingredients_id')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="ingredient_name" class="s-input" id="ingredient_name">
                        @error('ingredient_name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="ingredient_amount" class="" id="ingredient_amount">
                        @error('ingredient_amount')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="lot_amount" class="" id="lot_amount">
                        @error('lot_amount')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="lot_unit" class="" id="lot_unit">
                        @error('lot_unit')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="expiration" class="" id="expiration">
                        @error('expiration')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <button class="celladd">追加</button>
                    </td>
                    <td></td>
                </form>
            </tr>

            {{-- 既存の材料 --}}
            @forelse ($each as $item)
                <tr>
                    <form action="{{ route('cakes.ingredient.edit.update', $item) }}" method="post" class="update">
                        @csrf
                        @method('PATCH')
                        <td></td>
                        <td>
                            {{ $item->ingredient_name }}
                            <input type="hidden" name="ingredient_name" value="{{ $item->ingredient_name }}">
                        </td>
                        <td>
                            <input type="text" name="ingredient_amount" value="{{ $item->ingredient_amount }}"
                                class="">
                        </td>
                        <td>
                            <input type="text" name="lot_amount" value="{{ $item->lot_amount }}" class="">

                        </td>
                        <td>
                            <input type="text" name="lot_unit" value="{{ $item->lot_unit }}" class="">
                        </td>
                        <td>
                            <input type="text" name="expiration" value="{{ $item->expiration }}" class="">
                        </td>
                        <td>
                            <input type="hidden" name="basic_ingredients_id" value="{{ $basic->id }}">
                            <button>変更</button>
                        </td>
                    </form>
                    <td>
                        <form action="{{ route('cakes.ingredient.edit.destroy', $item) }}" method="post" class="delete">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="each_id" value="{{ $item->id }}">
                            <button class="celldelete">削除</button>
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

    <script>
        //材料追加
        (function($) {
            $('.celladd').on('click', function(e) {
                e.preventDefault();
                var basic_ingredients_id = $('#basic_ingredients_id').val();
                var ingredient_name = $('#ingredient_name').val();
                var ingredient_amount = $('#ingredient_amount').val();
                var lot_amount = $('#lot_amount').val();
                var lot_unit = $('#lot_unit').val();
                var expiration = $('#expiration').val();
                var CSRF = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: " {{ route('cakes.ingredient.edit.update') }}",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    },
                    method: "POST",
                    data: {
                        "basic_ingredients_id": basic_ingredients_id,
                        "ingredient_name": ingredient_name,
                        "ingredient_amount": ingredient_amount,
                        "lot_amount": lot_amount,
                        "lot_unit": lot_unit,
                        "expiration": expiration,
                    },
                    success: function(response) {
                        $('.exel-edit').append(`
                        <tr>
                    <form action="{{ route('cakes.ingredient.edit.update') }}" method="post" class="update">
                        <input type="hidden" name="_token" value="${CSRF}" autocomplete="off">
                        <td></td>
                        <td>
                            ${ingredient_name}
                            <input type="hidden" name="ingredient_name" value="${ingredient_name}">
                        </td>
                        <td>
                            <input type="text" name="ingredient_amount" value="${ingredient_amount}"
                                class="">
                        </td>
                        <td>
                            <input type="text" name="lot_amount" value="${lot_amount}" class="">

                        </td>
                        <td>
                            <input type="text" name="lot_unit" value="${lot_unit}" class="">
                        </td>
                        <td>
                            <input type="text" name="expiration" value="${expiration}" class="">
                        </td>
                        <td>
                            <input type="hidden" name="basic_ingredients_id" value="${basic_ingredients_id}">
                            <button>変更</button>
                        </td>
                    </form>
                    <td>
                        <form action="{{ route('cakes.ingredient.edit.destroy') }}" method="post" class="delete">
                        <input type="hidden" name="_token" value="${CSRF}" autocomplete="off">
                        <input type="hidden" name="basic_ingredients_id" value="${basic_ingredients_id}" class="delete">
                            <button>削除</button>
                        </form>

                    </td>
                </tr>
                   `)
                    }
                    // dataType: "",
                }).done(function() {
                    console.log('通信成功');
                }).fail(function() {
                    console.log('通信失敗');
                }).always(function() {
                    console.log('実行しました');
                });
            });
        })(jQuery);


        // 金額削除
        (function($) {
            $('.celldelete').on('click', function(e) {
                e.preventDefault();
                // 渡すデータ
                var each_id = $(this).siblings('[name="each_id"]').val();
                var CSRF = $('meta[name="csrf-token"]').attr('content');
                //削除する要素
                var delete_ingredient = $(this).parent().parent().parent();

                if (confirm('削除しますか？')) {
                    $.ajax({
                        url: "{{ route('cakes.ingredient.edit.destroy') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: {
                            "each_id": each_id,
                        },
                        success: function() {
                            //要素の削除
                            delete_ingredient.remove();
                        },
                        // dataType: "",
                    }).done(function() {
                        console.log('通信成功');
                    }).fail(function() {
                        alert('失敗しました');
                    }).always(function() {
                        console.log('実行しました');
                    });
                }
            });
        })(jQuery);
    </script>
@endsection
