@extends('components.footer')
@extends('components.aside')
@extends('components.header')


@section('contents')
    <main class="grid">
        <div class="subinfo">
            @forelse ($info as $info)
                <object>
                    <div class="boolean">
                        <img src="{{ asset($info->mainphoto) }} " class="subphoto" alt="ケーキの写真">
                        <p hidden>{{ $info->boolean }}</p>
                    </div>
                    <form method="POST" action="{{ route('boolean', $info) }}" id="update_boolean" class="update">
                        @method('PATCH')
                        @csrf
                        {{-- 商品表示切替ボタン --}}
                        @if ($info->boolean === 1)
                            <input type="hidden" name="boolean" value="0">
                            <button>非表示にする</button>
                        @else
                            <input type="hidden" name="boolean" value="1">
                            <button>表示する</button>
                        @endif
                    </form>
                    <a href="{{ route('info.edit', $info) }}">
                        <p class="smallfont">詳細変更</p>
                    </a>

                </object>
            @empty
                <p>コンテンツを用意してください</p>
            @endforelse
        </div>

        <script>
            'use strict';
            {
                // boolean判別用
                document.querySelectorAll('.boolean').forEach(element => {
                    const boolean = Number(element.querySelector('p').textContent);

                    if (boolean === 0) {
                        element.querySelector('img').classList.add('shadow');
                    }
                });

                // ボタン更新用
                document.querySelectorAll('.update').forEach(element => {
                    element.addEventListener('submit', e => {
                        e.preventDefault();
                        // switch()｛
                        if (!confirm('更新しますか？')) {
                            return;
                        }
                        e.target.submit();
                    })
                    // ｝
                });
            }
        </script>
    @endsection
