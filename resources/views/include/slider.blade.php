<div class="slider-container">
    @foreach ($sliders as $info)
        <div class="slide flex-row">
            <a href="{{ route('front.cake', $info->cake_info->id) }}">
                <img src="{{ asset($info->cake_info->mainphoto) }}" alt="商品画像" class="slider-photo">
            </a>
            <div>
                <p class="bigfont">{{ $info->cake_info->cakename }}</p>
                <p class="smallfont">{{ $info->cake_info->topic }}</p>
            </div>
        </div>
    @endforeach
</div>
