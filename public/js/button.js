'use strict';
{
    // boolean判別用
    document.querySelectorAll('.boolean').forEach(element => {
        const boolean = Number(element.querySelector('p').textContent);

        if (boolean === 0) {
            element.querySelector('img').classList.add('shadow');
        }
    });

    // ボタン更新用
    document.querySelectorAll('.update').forEach(element => {
        element.addEventListener('submit', e => {
            e.preventDefault();
            // switch()｛
            if (!confirm('更新しますか？')) {
                return;
            }
            e.target.submit();
        })
        // ｝
    });

    // ボタン削除用
    document.querySelectorAll('.delete').forEach(element => {
        element.addEventListener('submit', e => {
            e.preventDefault();
            if (!confirm('本当に削除しますか？')) {
                return;
            }
            e.target.submit();
        })

    });
}