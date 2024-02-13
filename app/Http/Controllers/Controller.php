<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    const MENU_ITEM = [
        'text' => 'SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!',
        'topic' => 'SampleText!SampleText!',
        'sectence' => 'SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!
        SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!SampleText!',
    ];

    // 定数なら使える 変数は無理！！
    // const MENU_ITEM = [
    //     'user' => 'ユーザー',
    //     'user_auth' => 'ユーザー権限',
    //     'blue_archive' => 'ブルーアーカイブ',
    // ];

    // const MESSAGES = [
    //     'create' => '登録しました。',
    //     'update' => '更新しました。',
    //     'delete' => '削除しました。',
    //     'error' => 'エラーが発生しました。',
    // ];

    // 呼び出し↓
    // return view('view_name', array_merge(
    //     $data, self::MENU_ITEM, self::MESSAGES
    // ));
}
