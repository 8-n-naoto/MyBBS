<div class="textbackground">
    @forelse ($reservations as $reservation)
        <div class="textbackground">
            <p class="form-font">ご予約日時：{{ $reservation->created_at }}</p>
            <p class="form-font">受取日：{{ $reservation->birthday }}</p>
            <p class="form-font">受け取り時間：{{ $reservation->time }}</p>
            <p class="form-font">予約名：{{ $reservation->user->name }}様</p>
            @forelse ($reservation->sub_reservations as $info)
                <div class="textbackground">
                    <p class="form-wrap-font">商品名：{{ $info->cakename }}</p>
                    <p class="form-font">大きさ：{{ $info->capacity }}</p>
                    <p class="form-font"> 値段：{{ $info->price }}円</p>
                    <p class="form-wrap-font">メッセージ：{{ $info->message }} </p>
                    <p class="form-font">ご予約番号：{{ $info->id }}</p>

                </div>
            @empty
                <p>予約情報が不足しています</p>
            @endforelse
        </div>
    @empty
        <p>予約がないよ！</p>
    @endforelse
</div>
