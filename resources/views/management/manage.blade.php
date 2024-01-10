{{-- <?php dd($info); ?> --}}

@extends('components.managementlayout')

@section('main')
    <section>

        @include('include.calender')

        <div class="textbackground flex-coulumn">
            {{-- <h3 class="today middlefont"></h3> --}}
            <p class="middlefont">{{ $day }}</p>
            @include('include.reservations')
        </div>

    </section>
    
    <script src="{{ url('js/calender.js') }}"></script>
@endsection
