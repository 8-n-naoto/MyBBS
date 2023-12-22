<x-layout>
    <main>
    <form method="POST" action="{{ route('register') }}" id="send_form">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('お名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード確認')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('登録済みの方はこちらへ') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>
    </form>
    </main>
    <script>
        'use strict'
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
</x-layout>

{{--
<x-layout>

    <h2>ログイン情報登録</h2>
    @if ($errors->any())
        <div>
            <div>Something went wrong!</div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
    @csrf

    <div>
        <label for="name">お名前</label>
        <input type="text" id="name" name="name" value="{{old('name')}}">
    </div>
    <div>
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{old('email')}}">
    </div>
    <div>
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" value="{{old('password')}}">
    </div>
    <div>
        <label for="password_confirmation">確認用パスワード</label>
        <input type="password_confirmation" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
    </div>
    <div>
        <label for="remember">
            <input id="remember" type="checkbox" name="remember">
            <span>ログイン状態を保持する</span>
        </label>
    <div>
        <button class="button" id="register">登録する</button>
    </div>
    </form>
    <script>
        'use strict'
        {
            document.getElementById('register').addEventListener('submit', e => {
                e.preventDefault();
                if (!confirm('購入に進みますか?')) {
                    return;
                }
                e.target.submit();
            });
        }
    </script>
</x-layout> --}}
