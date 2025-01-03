{{-- <?php dd($info->capasity); ?> --}}
@extends('components.frontlayout')

@section('title', '送信内容確認画面')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="informations">
        <form method="post" action="{{ route('front.result') }}" id="form_send" class="sendform">
            @csrf
            <div>
                <p class="form-font items">お名前:{{ $info->users_name }}</p>
                <input type="hidden" name="users_id" id="date" value="{{ $info->users_id }}">
            </div>
            <div>
                <p class="form-font items">受け取り日時:{{ $info->birthday }}</p>
                <input type="hidden" name="birthday" id="date" value="{{ $info->birthday }}">
            </div>
            <div>
                <p class="form-font items">受け取り時間:{{ $info->time }}</p>
                <input type="hidden" name="time" id="time" value="{{ $info->time }}">
            </div>
            <div>
                <img src="{{ asset($info->mainphoto) }}" width="240px">
                <p class="form-font items">ケーキの種類:{{ $info->cakename }}</p>
                <input type="hidden" name="cakename" id="cake" value="{{ $info->cakename }}">
            </div>
            <div>
                <p class="form-font items">大きさ:{{ $info->capacity }}</p>
                <input type="hidden" name="capacity" id="capacity" value="{{ $info->capacity }}">
            </div>
            <div>
                <p class="form-font items">お値段:{{ $info->price }}円</p>
                <input type="hidden" name="price" id="price" value="{{ $info->price }}">
            </div>
            <div>
                <p class="form-wrap-font items">
                    メッセ―ジ：{{ $info->message }}</p>
                <input type="hidden" name="message" id="message" value="{{ $info->message }}">
            </div>
            <div>
                <button class="sendbutton" id="button">内容を確定する</button>
            </div>

            {{-- なんかおかしいので直す「flex」が原因 --}}
            <div class="loader">
                <div class="sk-chase">
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
