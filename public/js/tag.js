
(function ($) {
    $('.tagbtn').on('click', function (e) {
        e.preventDefault();
        var tag = $('.tag').val();
        var cake_id = $('.cake_id').val();
        var CSRF = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "http://localhost:8569/management/cake/edit/update/addprice",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            method: "POST",
            data: {
                "cake_id": cake_id,
                "tag": tag,

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
            $('.tagtable').append(`
<tr>
            <td class="form-font"></td>
            <td class="form-font">${tag}</td>
            <td class="form-font"></td>
</tr>
          `  )
            // }
        });
    });
})(jQuery);
