<div class="slider-container">
    @foreach ($sliders as $info)
        <div class="slide flex-row">
            <a href="{{ route('front.cake', $info->cake_info->id) }}">
                <img src="{{ asset($info->cake_info->mainphoto) }}" alt="商品画像" class="slider-photo">
            </a>
            <div>
                <p class="bigfont">{{ $info->cake_info->cakename }}</p>
                <p class="smallfont">{{ $info->cake_info->topic }}</p>
                @forelse ($info->cake_info->cake_info_subs as $item)
                <div class="flex-row smallfont">
                    <p>内容量：{{ $item->capacity }}</p>
                    <p>価格：{{ $item->price }}円</p>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    @endforeach
</div>
