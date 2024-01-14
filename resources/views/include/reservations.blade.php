
<div>
    @forelse ($reservations as $reservation)
        <div class="textbackground">
            <p class="smallfont">ご予約日：{{ $reservation->birthday }}
            <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
            <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
            @forelse ($reservation->sub_reservations as $info)
                    <p class="smallfont">商品名：{{ $info->cakename }}</p>
                    <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                    <p class="smallfont"> 値段：{{ $info->price }}</p>
                    <p class="smallfont">メッセージ：{{ $info->massage }} </p>
            @empty
                <p>予約情報が不足しています</p>
            @endforelse
        </div>
    @empty
        <p>予約がないよ！</p>
    @endforelse
</div>
