<div class="slider-container">
    @foreach ($sliders as $info)
        <div class="slide flex-row">
            <a href="{{ route('front.cake', $info->cake_info->id) }}">
                <img src="{{ asset($info->cake_info->mainphoto) }}" alt="商品画像" class="slider-photo">
            </a>
            <div>
                <p class="middlefont">{{ $info->cake_info->cakename }}</p>
                <p class="form-font">商品説明：{{ $info->cake_info->topic }}</p>
                <table>
                    <tr>

                    </tr>
                    @foreach ($info->cake_info->cake_info_subs as $item)
                        <tr>
                            <td class="form-font">内容量</td>
                            <td class="form-font">{{ $item->capacity }}</td>
                            <td class="form-font">価格</td>
                            <td class="form-font">￥{{ $item->price }}円</td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    @endforeach
</div>
