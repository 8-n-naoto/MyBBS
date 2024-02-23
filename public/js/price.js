(function ($) {
    $('.pricebtn').on('click', function (e) {
        e.preventDefault();
        var capacity = $('.capacity').val();
        var price = $('.price').val();
        var cake_id = $('.cake_id').val();
        var  CSRF= $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "http://localhost:8569/management/cake/edit/update/addprice",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            method: "POST",
            data: {
                "cake_id": cake_id,
                "capacity": capacity,
                "price": price,

            },
            // dataType: "",
        }).done(function () {
            console.log('通信成功');
        }).fail(function () {
            console.log('通信失敗');
            alert('通信失敗');
        }).always(function () {
            console.log('実行しました');
        // success: function(json){
            $('.pricetable').append(`
                <tr>
                                <td class="form-font">内容量</td>
                                <td class="form-font">
                                    ${capacity}
                                </td>
                                <td class="form-font">価格</td>
                                <td class="form-font">
                                ￥${price}円
                                </td>
                                <td>
                                <form method="post" action="http://localhost:8569/management/cake/edit/1/destroyprice"
                                class="flex-row delete">
                                <input type="hidden" name"_method" value"DELETE">
                                <input type="hidden" name="_token" value="${CSRF}" autocomplete="off">

                                <input type="hidden" name='id' value="">
                                <button class="button">消去</button>
                            </form>
                                </td>
                            </tr>
          `  )
        // }
        });
    });
})(jQuery);
