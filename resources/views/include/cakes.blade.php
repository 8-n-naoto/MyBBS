<div class="cakephotos">
    @forelse ($infos as $info)
        <object class="gallery">
            <a href="{{ route('front.cake', $info->id) }}">
                <img src="{{ asset($info->mainphoto) }}" alt="ケーキの写真" class="menuphotos">
                <p class="cakenamefont">
                    {{ e($info->cakename) }}
                </p>
            </a>
            @include('include.favoritebutton')
        </object>
    @empty
        <p>ただいま準備中！</p>
    @endforelse
</div>
