@extends('components.frontlayout')

@section('title', '管理者ログイン登録')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.min.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')

    <section class="">
        <form method="POST" action="{{ route('admin.register') }}" id="send_form">
            @csrf
            <p class="bigfont">必要情報を入力してください</p>
            <table>
                <tbody class="login-form">
                    <!-- name -->
                    <tr>
                        <td>
                            <label for="name">お名前</label>
                        </td>
                        <td>
                            ：
                        </td>
                        <td>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                autofocus autocomplete="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <!-- Email Address -->
                    <tr>
                        <td>
                            <label for="email">Email</label>
                        </td>
                        <td>：</td>
                        <td>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            @error('email')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <!-- Password -->
                    <div class="mt-4">
                    </div>
                    <tr>
                        <td>
                            <label for="password">パスワード</label>
                        </td>
                        <td>：</td>
                        <td>
                            <input type="password" id="password" name="password" value="{{ old('password') }}" required
                                autofocus autocomplete="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <p>※8文字以上で入力してください</p>
                            @error('password')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <!-- Confirm password_confirmation -->
                    <tr>
                        <td>
                            <label for="password_confirmation">パスワード確認</label>
                        </td>
                        <td>：
                        </td>
                        <td>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" required autofocus
                                autocomplete="password_confirmation">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <p>※8文字以上で入力してください</p>
                            @error('password_confirmation')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <button class="form-font">登録する</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <a href="{{ route('admin.login') }}" class="form-font">
                                登録済みの方はこちらへ
                            </a>
                        </td>
                    </tr>
                </tbody>

        </form>
    </section>
    </table>

    <script>
        'use strict';
        {
            document.getElementById('send_form').addEventListener('submit', e => {
                e.preventDefault();
                if (!confirm('登録しますか？')) {
                    return;
                }
                e.target.submit();
            });
        }
    </script>
@endsection
