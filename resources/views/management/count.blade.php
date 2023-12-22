<?php
//    dd($info);
?>
<x-layout>
    <main>
        <h2 class="bigfont">{{ $name->cakename }}</h2>
        <div class="">
            <p class="middlefont">日付順(本日以降)</p>
            @forelse ($info as $info)
                <p class="smallfont">
                    {{ $info->birthday }}：{{ $info->username }}様：{{ $info->price }}：{{ $info->cakename }}：{{ $info->size }}：{{ $info->massage }}
                @empty
                <p>予約がないよ！</p>
            @endforelse

        </div>
    </main>
</x-layout>
