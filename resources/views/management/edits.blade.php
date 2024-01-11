@extends('components.managementlayout')
@section('main')
    <section class="grid">
        <div class="subinfo">
            @forelse ($cakeinfos as $info)
                <object>
                    <a href="{{ route('cakes.store.update', $info) }}">
                        <div class="boolean">
                            <img src="{{ asset($info->mainphoto) }} " class="subphoto" alt="ケーキの写真">
                            <p hidden>{{ $info->boolean }}</p>
                        </div>

                        <p class="smallfont">詳細変更</p>
                    </a>
                    <form method="POST" action="{{ route('cakes.boolean', $info) }}" id="update_boolean" class="update">
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
    </section>
    <script src="{{ url('js/button.js') }}"></script>
@endsection
