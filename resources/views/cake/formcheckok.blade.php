
@extends('components.frontlayout')
@section('main')
    <section class="">
        <div>
            <p>{{Auth::user()->name}}様の予約番号</p>
            <p>{{$mainID}}-{{$subID}}</p>
        <p class="">またのお越しをお待ちしております！</p>
        </div>
      <div>
        <a href="{{route('index')}}" alt="ホームに戻るよ！">
          <button>ホームへ戻る</button>
        </a>
      </div>
    </section>
@endsection


