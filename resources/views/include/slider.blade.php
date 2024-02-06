<div class="slider-container">
    @foreach ($infos as $info)
        <div class="slide flex-row">
            <a href="{{ route('front.cake', $info->id) }}">
                <img src="{{ asset($info->mainphoto) }}" alt="商品画像" class="slider-photo">
            </a>
            <div>
                <p class="bigfont">{{ $info->cakename }}</p>
                <p class="smallfont">{{ $info->topic }}</p>
            </div>
        </div>
    @endforeach
</div>
