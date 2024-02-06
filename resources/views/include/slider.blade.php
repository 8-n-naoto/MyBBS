<div class="slider-container">
    <h2 class="bigfont textbackground">イチオシ商品</h2>
    @foreach ($infos as $info)
        <div class="slide flex-row">
            <img src="{{ asset($info->mainphoto) }}" alt="商品画像" class="slider-photo">
            <div>
                <p class="bigfont">{{ $info->cakename }}</p>
                <p class="smallfont">{{ $info->topic }}</p>
            </div>
        </div>
    @endforeach
</div>
