(function ($) {
    $('.favorite').on('click', function (e) {
        e.preventDefault();
        var user_id = $(this).siblings('#favorite [name="user_id"]').val();
        var cake_id = $(this).siblings('#favorite [name="cake_id"]').val();
        var cakeinfos_id = $(this).siblings('#favorite [name="cakeinfos_id"]').val();
        $.ajax({
            url: "user/fovorite/add",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            method: "POST",
            data: {
                "user_id": user_id,
                "cake_id": cake_id,
                "cakeinfos_id": cakeinfos_id,
            },
            // dataType: "",
        }).done(function (res) {
            console.log('通信成功');
        }).fail(function () {
            console.log('通信失敗');
            alert('通信失敗');
        }).always(function (data) {
            console.log('実行しました');
            console.log(user_id);
            console.log(cake_id);
            console.log(cakeinfos_id);

        });
    });
})(jQuery);
