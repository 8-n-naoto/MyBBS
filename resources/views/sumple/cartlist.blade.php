@extends('components.frontlayout')

@section('main')
    <main>

        <div class="container">
            <div class="row">
                <div class="col-12 card border-dark mt-5">
                    <div class="cord-body ml-3 mb-2">
                        <h4 class="mt-4">お届け先</h4>
                        <p class="mb-2" style="padding-left: 20px;">
                            @if (Auth::check())
                                {{ $sessionUser->zipcode }}
                                {{ $sessionUser->prefecture }}
                                {{ $sessionUser->municipality }}
                                {{ $sessionUser->address }}
                                {{ $sessionUser->apartments }}
                            @endif
                        </p>
                        <p style="padding-left: 160px;">
                            @if (Auth::check())
                                {{ $sessionUser->last_name }}
                                {{ $sessionUser->first_name }}
                            @endif
                            様
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <table class="table mt-5 ml-3 border-dark">
                    <thead>
                        <tr class="text-center">
                            <th class="border-bottom border-dark" style="width:13%;">No</th>
                            <th class="border-bottom border-dark" style="width:18%;">商品名</th>
                            <th class="border-bottom border-dark" style="width:15%;">商品カテゴリ</th>
                            <th class="border-bottom border-dark" style="width:15%;">値段</th>
                            <th class="border-bottom border-dark" style="width:15%;">個数</th>
                            <th class="border-bottom border-dark" style="width:15%;">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartData as $key => $data)
                            <tr class="text-center">
                                <th class="align-middle">{{ $key += 1 }}</th>
                                <td class="align-middle">
                                    {{ $data['cake_name'] }}
                                </td>
                                <td class="align-middle">
                                    {{ $data['category_name'] }}
                                </td>
                                <td class="align-middle">
                                    ¥{{ number_format($data['price']) }} 円
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-outline-dark">
                                        {{ $data['session_quantity'] }}
                                    </button>
                                    個
                                </td>
                                <td class="align-middle">
                                    ¥{{ number_format($data['session_quantity'] * $data['price']) }}
                                </td>

                                <td class="border-0 align-middle">
                                    {{-- {!! Form::open(['route' => ['itemRemove', 'method' => 'post', $data['session_products_id']]]) !!} --}}
                                    <form method="POST" action="{{ route('itemRemove', $data['sesssion_products_id']) }}">
                                        {{-- {{ Form::submit('削除', ['name' => 'delete_cakes_id', 'class' => 'btn btn-danger']) }}
                                         --}}
                                        <button class="btn btn-dabger" name="delete_cakes_id">削除</button>
                                        {{-- {{ Form::hidden('cake_id', $data['session_products_id']) }} --}}
                                        <input type="hidden" name="cake_id" value="{{ $date['session_products_id'] }}">
                                        {{-- {{ Form::hidden('cake_quantity', $data['session_quantity']) }} --}}
                                        <input type="hidden" name="cake_quantity" value="{{ $date['session_quantity'] }}">
                                        <input type="hidden" name="message" value="{{ $date['message'] }}">
                                        {{-- {!! Form::close() !!} --}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="text-center">
                            <th class="border-bottom-0 align-middle"></th>
                            <td class="border-bottom-0 align-middle"></td>
                            <td class="border-bottom-0 align-middle"></td>
                            <td class="border-bottom-0 align-middle"></td>
                            <td class="border-bottom-0 align-middle">合計</td>
                            @php
                                $totalPrice = number_format(array_sum(array_column($cartData, 'itemPrice')));
                            @endphp
                            <td class="border-bottom-0 align-middle">
                                ¥{{ $totalPrice }}円
                            </td>
                        </tr>


                        <tr class="text-right">
                            <th class="border-0"></th>
                            <td class="border-0">
                                <a class="btn btn-success" href="{{ route('cake_search') }}" role="button">
                                    買い物を続ける
                                </a>
                            </td>
                            <td class="border-0"></td>
                            <td class="border-0"></td>
                            <td class="border-0">
                                {{-- {!! Form::open(['route' => ['orderFinalize', 'method' => 'post', $data['session_cakes_id']]]) !!} --}}
                                <form action="{{ route('orderFinalize', $data['session_cakes_id']) }}" method="post">
                                    {{-- {{ Form::submit('注文を確定する', ['name' => 'orderFinalize', 'class' => 'btn btn-primary']) }} --}}
                                    <button class="btn btn-primary">注文を確定する</button>
                                    {{-- {!! Form::close() !!} --}}
                                </form>
                            </td>
                            <td class="border-0 align-middle"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
