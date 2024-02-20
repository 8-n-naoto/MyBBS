@extends('components.managementlayout')

@section('title', '表示商品切り替え')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('main')
    <section>
        <p class="topic-font">商品表示切替</p>

        <div class="cakephotos">
            @forelse ($cakeinfos as $info)
                <object class="gallery">
                    {{-- 写真とリンク --}}
                    <a href="{{ route('cakes.upudate.store', $info) }}">
                        <div class="boolean">
                            <img src="{{ asset($info->mainphoto) }} " class="menuphotos" alt="ケーキの写真">
                            <p hidden>{{ $info->boolean }}</p>
                        </div>
                        <p class="cakenamefont">詳細変更</p>
                    </a>

                    {{-- 商品表示切替ボタン --}}
                    <form method="POST" action="{{ route('cakes.boolean', $info) }}" id="update_boolean" class="update">
                        @method('PATCH')
                        @csrf
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
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
