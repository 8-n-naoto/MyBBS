(function ($) {
    $.ajax({  // jQueryのajaxでjsonデータを取得しますね
        type: 'GET',
        // url: 'https://graph.facebook.com/v13.0/「InstagramビジネスID」?access_token=「アクセスTOKEN」&fields=name,media{caption,like_count,media_url,permalink,timestamp,username}', //本家用
        url: 'http://localhost:8569/front/instagramAPI/ajxa',  //開発環境用
        dataType: 'json',
        success: function (response) {
            var insta = response.media;
            console.log(insta);
            for (var i = 0; i < 8; i++) {
                let url = insta[i].media_url; // 動画ソースのURLを取得
                let href = insta[i].permalink; // リンク先URLを取得
                let caption = insta[i].caption; //投稿のキャプションを取得(使わないので消すかもしれない)
                let like = insta[i].like_count; //いいね！数の取得
                // if (url.indexOf('.mp4') <= 0) { // 動画は除外 .mp4以外を<li>タグで描画します
                $('.insta_list').append(`
                        <object class="gallery">
                            <a href="${href}" target="qoo_insta">
                                <img src="${url}" alt="${caption}" class="APIphoto">
                                <p>${caption}</p>
                                <p><span>${like}</span> Likes!!</p>
                            </a>
                        </object>
              `);
            }
        }
    });
})(jQuery);
