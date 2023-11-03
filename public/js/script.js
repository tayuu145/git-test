
// ハンバーガー
$(function () {
  // [.syncer-acdn]にクリックイベントを設定する
  $('.syncer-acdn').click(function () {
    // [data-target]の属性値を代入する
    var target = $(this).data('target');

    // [target]と同じ名前のIDを持つ要素に[slideToggle()]を実行する
    $('#' + target).slideToggle();

    // 終了
    return false;
  });
});

$(function () {
  $('.menu-trigger').click(function () {        //ハンバーガーボタン（.menu-trigger）をタップすると、
    $(this).toggleClass('active');              //タップしたハンバーガーボタン（.menu-trigger）に（.active）を追加・削除する。
    if ($(this).hasClass('active')) {           //もし、ハンバーガーボタン（.menu-trigger）に（.active）があれば、
      $('.g-navi').addClass('active');          //(.g-navi)にも（.active）を追加する。
    } else {                                    //それ以外の場合は、
      $('.g-navi').removeClass('active');       //(.g-navi)にある（.active）を削除する。
    }
  });
  $('.nav-wrapper ul li a').click(function () { //各メニューリンク（.nav-wrapper ul li a）をタップすると、
    $('.menu-trigger').removeClass('active');   //ハンバーガーボタン（.menu-trigger）にある（.active）を削除する。
    $('.g-navi').removeClass('active');         //(.g-navi)にある（.active）も削除する。
  });
});



// $(function () {
//   $('.ac-parent').on('click', function () {
//     $(this).next().slideToggle();
//   });
// });

// $(function () {
//   $('#toggleIcon').on('click', function () {
//     $(this).next().slideToggle();
//   });
// });
//                    ↓投稿内容の変数に多分post
$(function () {
  // 編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {
    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
    // 押されたボタンから投稿内容を取得し変数へ格納
    var post = $(this).attr('post');
    // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
    var post_id = $(this).attr('post_id');

    // 取得した投稿内容をモーダルの中身へ渡す
    $('.modal_post').text(post);
    // 取得した投稿のidをモーダルの中身へ渡す
    $('.modal_id').val(post_id);
    return false;
  });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });
});
