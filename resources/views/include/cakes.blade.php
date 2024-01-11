<div class="cakephotos">
    @forelse ($infos as $info)
        <object>
            <a href="{{ route('front.cake', $info->id) }}">
                <p class="cakenamefont">
                <img src="{{ asset($info->mainphoto) }}" class="menuphotos" alt="ケーキの写真">
                {{ e($info->cakename) }}</p>
            </a>
        </object>
    @empty
        <p>ただいま準備中！</p>
    @endforelse
</div>
