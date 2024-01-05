@extends('components.footer')
@extends('components.aside')
@extends('components.header')


@section('contents')
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


    </body>
    @endsection
