<x-layout>

    <main class="grid">
        <div class="subinfo">
            @forelse ($info as $info)
                <object>

                    <a href="{{ route('info.edit', $info) }}">
                        <img src="{{ asset($info->mainphoto) }} " class="subphoto" alt="ケーキの写真">
                        <p class="smallfont">on/off</p>
                        <p class="smallfont">詳細変更</p>
                    </a>
                </object>
            @empty
                <p>コンテンツを用意してください</p>
            @endforelse
        </div>
        <a href="{{ route('create') }}">新規追加</a>
        <a href="{{ route('management') }}">管理画面ホームへ</a>

    </main>

    </body>
    <script src="{{ url('js/main.js') }}"></script>
</x-layout>
