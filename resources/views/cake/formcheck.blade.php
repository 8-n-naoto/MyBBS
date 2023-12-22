{{-- <?php dd($info->capasity); ?> --}}

<x-layout>
    <main class="form">
        <form method="post" action="{{ route('reservation') }}" id="form_send">
            @csrf
            <div>
                <p>お名前:{{ $info->users_id }}</p>
                <input type="hidden" name="users_id" id="date" value="{{ $info->users_id }}">
            </div>
            <div>
                <p>受け取り日時:{{ $info->birthday }}</p>
                <input type="hidden" name="birthday" id="date" value="{{ $info->birthday }}">
            </div>
            <div>
                <p>受け取り時間:{{ $info->time }}</p>
                <input type="hidden" name="time" id="time" value="{{ $info->time }}">
            </div>
            <div>
                <img src="{{ asset($info->mainphoto) }}" width="240px">
                <p>ケーキの種類:{{ $info->cakename }}</p>
                <input type="hidden" name="cakename" id="cake" value="{{ $info->cakename }}">
            </div>
            <div>
                <p>大きさ:{{ $info->capacity }}</p>
                <input type="hidden" name="capacity" id="capacity" value="{{ $info->capacity }}">
            </div>
            <div>
                <p>お値段:{{ $info->price }}円</p>
                <input type="hidden" name="price" id="price" value="{{ $info->price }}">
            </div>
            <div>
                メッセ―ジ：{{ $info->massage }}
                <input type="hidden" name="massage" id="massage" value="{{ $info->massage }}">
            </div>
            <div>
                <button class="button" id="button">内容を確定する</button>
            </div>
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
    </main>
    <script>
        'use strict'
        {

            // ローダー用
            const myFunc = () => {

                const form = document.forms[1];
                const button = form.querySelector('button');
                const loader = form.querySelector('.loader');
                console.log(loader);

                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    //ローダーを表示する
                    loader.style.display = 'block';

                    form.submit();
                }, false);
            };
            myFunc();

            document.getElementById('form_send').addEventListener('submit', e => {
                e.preventDefault();
                if (!confirm('購入に進みますか?')) {
                    return;
                }
                e.target.submit();
            });
        }
    </script>

</x-layout>
