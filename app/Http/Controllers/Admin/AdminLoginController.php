<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use  App\Models\CakeInfo;
use  App\Models\Main_reservation;
use  App\Models\Sub_reservation;
use Carbon\Carbon;
use App\Models\Tag;

class AdminLoginController extends Controller
{
    // ログイン画面呼び出し
    public function showLoginPage(): View
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');

        return view('admin.auth.login')->with([
            'infos' => $infos,
            'tags' => $tags,
        ]);
    }

    // ログイン実行
    public function login(LoginRequest $request): RedirectResponse
    {
        $day = Carbon::today()->format('m月d日のご予約');
        $info = CakeInfo::all();
        $infosub = Sub_reservation::all();
        $today = Carbon::today();
        $reservation = Main_reservation::whereDate('birthday', $today)->get();

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('management')->with([
                'day' => $day,
                'infosubs' => $infosub,
                'reservations' => $reservation,
                'cakeinfos' => $info,
            ]);
        }
    }




    //logout実行?(トークン)
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
