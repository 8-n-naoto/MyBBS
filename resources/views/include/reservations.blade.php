<div class="textbackground">
    @forelse ($reservations as $reservation)
        <div class="textbackground">
            <p class="smallfont">ご予約日時：{{ $reservation->created_at }}</p>
            <p class="smallfont">受取日：{{ $reservation->birthday }}</p>
            <p class="smallfont">受け取り時間：{{ $reservation->time }}</p>
            <p class="smallfont">予約名：{{ $reservation->user->name }}様</p>
            @forelse ($reservation->sub_reservations as $info)
                <div class="textbackground">
                    <p class="smallfont">商品名：{{ $info->cakename }}</p>
                    <p class="smallfont">大きさ：{{ $info->capacity }}</p>
                    <p class="smallfont"> 値段：{{ $info->price }}円</p>
                    <p class="smallfont">メッセージ：{{ $info->message }} </p>
                    <p class="smallfont">ご予約番号：{{ $info->id }}</p>

                </div>
            @empty
                <p>予約情報が不足しています</p>
            @endforelse
        </div>
    @empty
        <p>予約がないよ！</p>
    @endforelse
</div>
