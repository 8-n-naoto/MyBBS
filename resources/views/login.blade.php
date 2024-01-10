{{-- 
@extends('components.frontlayout')

@section('main')
    <section class="form">
        <form method="post" action="{{ route('index') }}">
            @csrf
            <div>
                <label for="name">お名前:
                    <input type="text" name="username" id="name" placeholder="フルネームで入力して下さい"></label>
            </div>
            <div>
                <label for="e-mail">メールアドレス:
                    <input type="email" name="e-mail" id="e-mail"></label>
            </div>
            <div>
                <label for="password">パスワード:
                    <input type="password" name="password" id="password"></label>
            </div>
            <div>
                <button class="button">確認画面へ！</button>
            </div>
        </form>
    </section>

@endsection --}}
