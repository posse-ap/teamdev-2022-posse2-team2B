<script>
  // ページIDを取得
  const pageId = <?= $pgdata['page_id']; ?>;

  // 現在いるページのナビゲーションボタンの色を変える
  if (document.getElementById(`nav_item_${pageId}`) !== null) {
    const navItem = document.getElementById(`nav_item_${pageId}`);
    navItem.style.backgroundColor = '#eee';
  }

  // ナビゲーションボタンを押した時、ページ切り替え
  function changePage(pageName) {
    location.href = `/admin/${pageName}`;
  }
</script>
