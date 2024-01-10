{{-- <?php dd($info); ?> --}}

@extends('components.managementlayout')
@section('main')
    <section>
        <form method="POST" action="{{ route('thedate') }}">
            @csrf
            <label for="date" class="textbackground">
                <input type="date" name="date">日にちを選択してください
                <button>決定</button>
            </label>
        </form>

        <div>
            <div>
                <p class="smallfont">{{ $date }}</p>
                @forelse ($reservations as $reservation)
                    <div class="smallfont">
                        <p class="smallfont">ご予約日：{{ $reservation->birthday }} 受け取り時間：{{ $reservation->time }}
                            予約名：{{ $reservation->user->name }}様</p>
                        @forelse ($infosubs as $info)
                            @if ($reservation->id === $info->main_reservation_id)
                                <p class="smallfont">商品名：{{ $info->cakename }} 大きさ：{{ $info->capacity }}
                                    値段：{{ $info->price }} メッセージ：{{ $info->massage }} </p>
                            @endif
                        @empty
                            <p>予約情報が不足しています</p>
                        @endforelse
                    </div>
                @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
