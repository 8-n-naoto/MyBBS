{{-- <?php dd($tags); ?> --}}

@extends('components.frontlayout')
@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/instagram.css') }}">
@endsection

@section('head-js')
    <script src="{{ url('js/instagram.API.js') }}"></script>
@endsection

@section('js')
    <script src="{{ url('js/slider.js') }}"></script>
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <div>
        <h2 class="bigfont textbackground">イチオシ商品</h2>
    </div>
    @include('include.slider')
    <div>
        <h1 class="bigfont textbackground">デコレーションケーキ</h1>
        @include('include.cakes')
    </div>

    <div class="about-me section">
        <h2 class="about-me-main-font">お店の紹介</h2>
        <p class="about-me-font">当店は○○○○○○○○で</p>
        <p class="about-me-font">○○○○○○○○</p>
        <p class="about-me-font">○○○○なお店です</p>
    </div>
    {{-- instagramAPI --}}
    <div class="section">
        <h3 class="bigfont textbackground">最新情報一覧</h3>
        <ul class="insta_list"></ul>
    </div>

    @include('include.google-map')
    <button id="test">ajax</button>
    <div class="result"></div>

    <script>
        $(function(){
          // 「Ajax通信」ボタンをクリックしたら発動
          $('#ajax').on('click',function(){
            $.ajax({
              url:'./nana.php',
              type:'POST',
              data:{
                'answer':$('#answer').val()
              }
            })
            // Ajax通信が成功したら発動
            .done( (data) => {
              $('.result').html(data);
            })
            // Ajax通信が失敗したら発動
            .fail( (jqXHR, textStatus, errorThrown) => {
              alert('Ajax通信に失敗しました。');
              console.log("jqXHR          : " + jqXHR.status); // HTTPステータスを表示
              console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラーなどのエラー情報を表示
              console.log("errorThrown    : " + errorThrown.message); // 例外情報を表示
            })
            // Ajax通信が成功・失敗のどちらでも発動
            .always( (data) => {
              if($('#answer').val() == '小松菜奈'){
                console.log('あなたは正しい');
              }else{
                console.log('あなたは間違っている');
              }
            });
          });
        });
      </script>
@endsection
