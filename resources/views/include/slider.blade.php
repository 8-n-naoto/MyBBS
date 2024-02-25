<div class="slider-container">
    @foreach ($sliders as $info)
        <div class="slide flex-row">
            <a href="{{ route('front.cake', $info->cake_info->id) }}">
                <img src="{{ asset($info->cake_info->mainphoto) }}" alt="商品画像" class="slider-photo">
            </a>
            <div>
                <p class="middlefont">{{ $info->cake_info->cakename }}</p>
                <table>
                    <tbody>
                        <tr>
                            <td class="form-font">商品説明</td>
                            <td>{{ $info->cake_info->topic }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($info->cake_info->cake_info_subs as $item)
                            <tr>
                                <td class="form-font">内容量</td>
                                <td class="form-font">{{ $item->capacity }}</td>
                                <td class="form-font">価格</td>
                                <td class="form-font">￥{{ $item->price }}円</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
