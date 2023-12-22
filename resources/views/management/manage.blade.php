{{-- <?php dd($info); ?> --}}
<x-layout>
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
                <select size="4" name="ケーキの種類" onChange="location.href=value;" class="textbackground">
                    @forelse ($info as $info)
                        <option value="{{ route('count', $info->id) }}">{{ $info->cakename }}</option>
                    @empty
                        <p>準備中だよ！</p>
                    @endforelse
                </select>
            </div>
            <a href="{{ route('cakeinfos') }}" class="button">商品編集画面へ</a>
            <!-- 種類ごとに合計の予約数を出す。 -->
            <a href="{{ route('date') }}">日付別確認画面へ</a>
        </section>


        <div class="textbackground flex-coulumn">
            <h3 class="today middlefont"></h3>
            <div class="">
                <p class="middlefont"></p>
                <div class="flex-row">
                    @forelse ($reservations as $reservation)
                        <p class="smallfont">
                            {{ $reservation->birthday }}：{{ $reservation->time }}：
                        </p>
                        @forelse ($users as $user)
                            @if ($reservation->users_id === $user->id)
                                <p class="smallfont">
                                    {{ $user->name }}様
                                </p>
                            @endif
                        @empty
                        @endforelse
                </div>
                <div>
                    @forelse ($infosub as $info)
                        @if ($reservation->id === $info->main_reservation_id)
                            <p class="smallfont">
                                {{ $info->cakename }}：{{ $info->capacity }}：{{ $info->price }}：{{ $info->massage }}
                            </p>
                        @endif
                    @empty
                    @endforelse
                    @empty
                    <p>予約がないよ！</p>
                    @endforelse
                </div>
            </div>
            <script src="{{ url('js/main.js') }}"></script>
    </main>

    </body>

</x-layout>
