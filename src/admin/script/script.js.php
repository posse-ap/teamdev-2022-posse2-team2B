<script>
  // ページIDを取得
  const pageId = <?= $pgdata['page_id']; ?>;

  // 現在いるページのナビゲーションボタンの色を変える
  const navItem = document.getElementById(`nav_item_${pageId}`);
  navItem.style.backgroundColor = '#ccc';

  // ナビゲーションボタンを押した時、ページ切り替え
  function changePage(pageName) {
    location.href = `/admin/${pageName}`;
  }
</script>
