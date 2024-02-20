@extends('components.frontlayout')

@section('title', 'お客様ログイン')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.min.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="">
        <form method="POST" action="{{ route('login') }}" id="send_form">
            @csrf
            <p class="bigfont">お客様情報を入力してください</p>
            <table>
                <tbody class="login-form">
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

                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="remember">
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('ログイン情報を保持しますか？') }}</span>
                                </label>
                            </div>
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
                            <a href="{{ route('register') }}" class="form-font">
                                未登録の方はこちらへ
                            </a>
                        </td>
                    </tr>
                </tbody>

        </form>
    </section>
    </table>
@endsection
