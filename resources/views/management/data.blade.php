{{-- <?php dd($info); ?> --}}

@extends('components.managementlayout')
@section('main')
    <form method="POST" action="{{ route('thedate') }}">
        @csrf
        <label for="date" class="textbackground">
            <input type="date" name="date">日にちを選択してください
            <button>決定</button>
        </label>
    </form>

    <div>
        @include('include.reservations')
    </div>
@endsection
