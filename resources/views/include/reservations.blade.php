<div>
    @forelse ($reservations as $reservation)
        <div class="textbackground">
            <p class="smallfont">ご予約日：{{ $reservation->birthday }}
            <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
            <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
            @forelse ($infosubs as $info)
                @if ($reservation->id === $info->main_reservation_id)
                    <p class="smallfont">商品名：{{ $info->cakename }}</p>
                    <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                    <p class="smallfont"> 値段：{{ $info->price }}</p>
                    <p class="smallfont">メッセージ：{{ $info->massage }} </p>
                @endif
            @empty
                <p>予約情報が不足しています</p>
            @endforelse
        </div>
    @empty
        <p>予約がないよ！</p>
    @endforelse
</div>
{{-- <div>
    @forelse ($reservations as $reservation)
        <div class="textbackground">
            <p class="smallfont">ご予約日：{{ $reservation->birthday }}
            <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
            <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
            <p class="smallfont">商品名：{{ $reservation->sub_reservations->cakename }}</p>
            <p class="smallfont">大きさ：{{ $reservation->sub_reservations->capacity }}</p>
            <p class="smallfont"> 値段：{{ $reservation->sub_reservations->price }}</p>
            <p class="smallfont">メッセージ：{{ $reservation->sub_reservations->massage }} </p>
        </div>
    @empty
        <p>予約がないよ！</p>
    @endforelse
</div> --}}
