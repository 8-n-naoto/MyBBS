<form method="POST" action="{{ route('user.add.cart') }}">
    @csrf
    @isset($cakeinfos)
        <input type="hidden" name="cakeinfos_id" value="{{ $cakeinfos->id }}">
    @endisset
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="cake_id" value="{{ $info->id }}">
    <button>カートに入れる</button>
</form>
