@extends('components.frontlayout')
@section('css')
<link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
<link rel="stylesheet" href="{{ url('css/font.css') }}">
<link rel="stylesheet" href="{{ url('css/form.css') }}">
<link rel="stylesheet" href="{{ url('css/instagram.css') }}">
@endsection

@section('js')
<script src="{{ url('js/instagram.API.js') }}"></script>
@endsection

@section('main')
    <section>
        {{-- <p>{{$sumple}}</p> --}}
        <h1 class="bigfont textbackground">カート</h1>
        <div class="cakephotos">
            @forelse ($infos as $info->cake_info)
                <object>
                    <a href="{{ route('front.cake', $info->id) }}">
                        <p class="cakenamefont">
                        <img src="{{ asset($info->mainphoto) }}" class="menuphotos" alt="ケーキの写真">
                        {{ e($info->cakename) }}</p>
                    </a>
                </object>
            @empty
                <p>ただいま準備中！</p>
            @endforelse
        </div>
    </section>

@endsection
