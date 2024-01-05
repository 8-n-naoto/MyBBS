{{-- <?php dd($infosubs);?> --}}
@extends('components.footer')
@extends('components.aside')
@extends('components.header')

@section('contents')
    <main>
        <h2 class="bigfont">{{ $name->cakename }}</h2>
        <div class="">
            @forelse ($infosubs as $info)
                <div class="textbackground">
                    @forelse ($reservations as $reservation)
                        @if ($info->main_reservation_id === $reservation->id)
                            <p class="smallfont">ご予約日：{{ $reservation->birthday }} 受け取り時間：{{ $reservation->time }}
                                予約名：{{ $reservation->user->name }}様</p>
                        @endif
                    @empty
                        <p>基本情報が足りていません</p>
                    @endforelse
                    <p class="smallfont">商品名：{{ $info->cakename }} 大きさ：{{ $info->capacity }}
                        値段：{{ $info->price }} メッセージ：{{ $info->massage }} </p>
                </div>
            @empty
                <p>準備中です</p>
            @endforelse
        </div>
    @endsection
