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
                    <a href="{{ route('info.edit', $info) }}">
                        <p class="smallfont">詳細変更</p>
                    </a>
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

                </object>
            @empty
                <p>コンテンツを用意してください</p>
            @endforelse
        </div>
        <script src="{{ url('js/button.js') }}"></script>
    @endsection
