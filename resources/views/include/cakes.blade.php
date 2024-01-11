<div class="subinfo">
    @forelse ($infos as $info)
        <object>
            <a href="{{ route('front.cake', $info->id) }}">
                <img src="{{ asset($info->mainphoto) }}" class="subphoto" alt="ケーキの写真">
                <p class="smallfont">{{ e($info->cakename) }}</p>
            </a>
        </object>
    @empty
        <p>ただいま準備中！</p>
    @endforelse
</div>
