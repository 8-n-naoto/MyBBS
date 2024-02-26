<div class="textbackground">



    <table class="formtable">
        @forelse ($reservations as $reservation)
            <tbody>
                <tr>
                    <td class="form-font">ご予約日時</td>
                    <td class="form-font">：</td>
                    <td class="form-font">{{ $reservation->created_at }}</td>
                </tr>
                <tr>
                    <td class="form-font">受取日</td>
                    <td class="form-font">：</td>
                    <td class="form-font">{{ $reservation->birthday }}</td>
                </tr>
                <tr>
                    <td class="form-font">受け取り時間</td>
                    <td class="form-font">：</td>
                    <td class="form-font">{{ $reservation->time }}</td>
                </tr>
                <tr>
                    <td class="form-font">予約名様</td>
                    <td class="form-font">：</td>
                    <td class="form-font">{{ $reservation->user->name }}様</td>
                </tr>
                @forelse ($reservation->sub_reservations as $info)
                    <tr>
                        <td class="form-font"></td>
                        <td class="form-font"></td>
                        <td class="form-font">
                            <table>
                                <tbody>

                                    <tr>
                                        <td class="form-font">商品名</td>
                                        <td class="form-font">：</td>
                                        <td class="form-wrap-font">{{ $info->cakename }}</td>
                                    </tr>
                                    <tr>
                                        <td class="form-font">大きさ</td>
                                        <td class="form-font">：</td>
                                        <td class="form-font">{{ $info->capacity }}</td>
                                    </tr>
                                    <tr>
                                        <td class="form-font">価格</td>
                                        <td class="form-font">：</td>
                                        <td class="form-font">{{ $info->price }}円</td>
                                    </tr>
                                    <tr>
                                        <td class="form-font">メッセージ</td>
                                        <td class="form-font">：</td>
                                        <td class="form-wrap-font">{{ $info->message }}</td>
                                    </tr>
                                    <tr>
                                        <td class="form-font">ご予約番号</td>
                                        <td class="form-font">：</td>
                                        <td class="form-font">{{ $info->id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @empty
                    <p>予約情報が不足しています</p>
                @endforelse
            </tbody>
        @empty
            <p>予約がないよ！</p>
        @endforelse
    </table>

</div>
