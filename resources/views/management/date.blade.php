{{-- <?php dd($info); ?> --}}
<x-layout>
    <main>
        <label for="" class="textbackground">
            <input type="date">日にちを選択してください
        </label>

        <div class="flex-row">
            <div>
                @forelse ($info as $info)
                    <p class="smallfont">
                        {{ $info->birthday }}：{{ $info->users_id }}様：{{ $info->time }}
                    @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>
            <div>
                @forelse ($info_sub as $info)
                    <p class="smallfont">
                        ケーキ：{{ $info->cakename }}：{{ $info->capacity }}：{{ $info->price }}円：{{ $info->massage }}
                    @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>

        </div>
    </main>
</x-layout>
