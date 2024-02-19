@if (Auth::user())
    <form method="POST" action="{{ route('user.favorite.add') }}" id="favorite">
        @csrf
        @isset($cakeinfos)
            <input type="hidden" name="cake_id" value="{{ $cakeinfos->id }}">
        @endisset
        @isset($info)
        <input type="hidden" name="cake_id" value="{{ $info->id }}">
        @endisset
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <button class="favorite">♥</button>
    </form>
@endif
