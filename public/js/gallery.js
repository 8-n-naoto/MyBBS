
(function ($) {
    $('.gallerybtn').on('click', function (e) {
        e.preventDefault();
        var galleryphoto = $('.galleryphoto').val();
        var galleryname = $('.galleryname').val();
        var cake_id = $('.cake_id').val();
        var CSRF = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "http://localhost:8569/management/cake/edit/update/addphoto",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
            method: "POST",
            data: {
                "cake_id": cake_id,
                "photoname": galleryname,
                "subphotos":galleryphoto,

            },
            // dataType: "",
        }).done(function () {
            console.log('通信成功');
        }).fail(function () {
            console.log('通信失敗');
            alert('通信失敗');
        }).always(function () {
            console.log('実行しました');
            console.log(galleryname);
            console.log(galleryphoto);
            // success: function(json){
            $('.cakephotos').append(`
            <object class="gallery">
             <img src="  http://localhost:8569/storage/images/${galleryphoto}" alt="商品画像"width="200px">
             <div class="flex-row item-end">
                <p>${galleryname}</p>
                <form method="post" action="{{ route('cakes.photo.destroy', $subphoto) }}" class="delete">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="info" value="${cake_id}">
                    <button class="button">消去</button>
                </form>
             </div>
            </object>
          `  )
            // }
        });
    });
})(jQuery);
