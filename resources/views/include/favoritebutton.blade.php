@if (Auth::user())
    <form method="POST" action="{{ route('user.favorite.add') }}">
        @csrf
        @isset($cakeinfos)
            <input type="hidden" name="cakeinfos_id" value="{{ $cakeinfos->id }}">
        @endisset
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="cake_id" value="{{ $info->id }}">
        <button>お気に入り登録</button>
    </form>
@endif
