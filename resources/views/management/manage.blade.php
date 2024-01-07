{{-- <?php dd($info); ?> --}}

@extends('components.footer')
@extends('components.aside')
@extends('components.header')

@section('contents')
    <main class="flex-row">
        <section>
            <div>
                <a href="/management/manage">
                    <h2 class="bigfont">管理画面だよ！</h2>
                </a>
            </div>

            <div class="flex-column">
                <table class="textbackground">
                    <thead>
                        <tr>
                            <th id="prev">&laquo;</th>
                            <th id="title" colspan="5">2020/05</th>
                            <th id="next">&raquo;</th>
                        </tr>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td id="today" colspan="7">Today</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </section>


        <div class="textbackground flex-coulumn">
            {{-- <h3 class="today middlefont"></h3> --}}
            <p class="middlefont">{{$day}}</p>
            <div>
                @forelse ($reservations as $reservation)
                    <div class="smallfont">
                        <p class="smallfont">ご予約日：{{ $reservation->birthday }} 受け取り時間：{{ $reservation->time }}
                            予約名：{{ $reservation->user->name }}様</p>
                        @forelse ($infosub as $info)
                            @if ($reservation->id === $info->main_reservation_id)
                                <p class="smallfont">商品名：{{ $info->cakename }} 大きさ：{{ $info->capacity }}
                                    値段：{{ $info->price }} メッセージ：{{ $info->massage }} </p>
                            @endif
                        @empty
                            <p>予約情報が不足しています</p>
                        @endforelse
                    </div>
                @empty
                    <p>予約がないよ！</p>
                @endforelse
            </div>
        </div>
        <script src="{{ url('js/calender.js') }}"></script>

    @endsection
