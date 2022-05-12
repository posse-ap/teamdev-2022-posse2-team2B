// 大きい再検索のSectionの方
$(function () {
  $('.Re-search__ac__parent').on('click', function () {
    $(this).next().slideToggle();
    //openクラスをつける
    $(this).toggleClass("open");
    //クリックされていないac-parentのopenクラスを取る
    $('.Re-search__ac__parent').not(this).removeClass('open');

    // 一つ開くと他は閉じるように
    $('.Re-search__ac__parent').not($(this)).next('.Re-search__ac__child').slideUp();
  });
});


// XXXXから選ぶのほう
$(function () {
  $('.Re-search-tags__ac__parent').on('click', function () {
    $(this).next().slideToggle();
    //openクラスをつける
    $(this).toggleClass("open");
    //クリックされていないac-parentのopenクラスを取る
    $('.Re-search-tags__ac__parent').not(this).removeClass('open');

    // 一つ開くと他は閉じるように
    $('.Re-search-tags__ac__parent').not($(this)).next('.Re-search-tags__ac__child').slideUp();
  });
});