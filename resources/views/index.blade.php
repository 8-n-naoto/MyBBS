@extends('components.footer')
@extends('components.google-map')
@extends('components.header')
{{-- <?php dd($infos); ?> --}}

@section('main')
    <main>
        <h1 class="bigfont">デコレーションケーキ</h1>
        <div class="subinfo">
            @forelse ($infos as $info)
                <object>
                    <a href="{{ route('cake.cakeinfo', $info->id) }}">
                        <img src="{{ asset($info->mainphoto) }}" class="subphoto" alt="ケーキの写真">
                        <p class="smallfont">{{ e($info->cakename) }}</p>
                    </a>
                </object>
            @empty
                <p>ただいま準備中！</p>
            @endforelse
        </div>

        {{-- <div class="textbackground">
            <form class="h-adr">
                <span class="p-country-name" style="display:none;">Japan</span>
                <label class="flex-row">〒<input type="text" class="p-postal-code textbackground" size="3"
                        maxlength="3">-<input type="text" class="p-postal-code textbackground" size="4"
                        maxlength="4"></label><br>
                <label>
                    <span>都道府県</span>
                    <input type="text" class="p-region text background" readonly /><br>
                </label>
                <label>
                    <span>市町村区</span>
                    <input type="text" class="p-locality text background" readonly /><br>
                </label>
                <label>
                    <span>町域</span>
                    <input type="text" class="p-street-address textbackground" /><br>
                </label>
                <label>
                    <span>以降の住所</span>
                    <input type="text" class="p-extended-address textbackground" />
                </label>
            </form>
        </div> --}}
    @endsection
