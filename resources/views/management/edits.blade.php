@extends('components.managementlayout')

@section('css')
<link rel="stylesheet" href="{{ url('css/font.css') }}">
<link rel="stylesheet" href="{{ url('css/aside.css') }}">
<link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
@endsection

@section('main')
    <section>
        <div class="cakephotos">
            @forelse ($cakeinfos as $info)
                <object>
                    {{-- 写真とリンク --}}
                    <a href="{{ route('cakes.upudate.store', $info) }}">
                        <div class="boolean">
                            <img src="{{ asset($info->mainphoto) }} " class="subphoto" alt="ケーキの写真">
                            <p hidden>{{ $info->boolean }}</p>
                        </div>
                        <p class="smallfont">詳細変更</p>
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

