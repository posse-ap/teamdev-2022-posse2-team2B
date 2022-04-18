// 現在いるページのナビゲーションボタンの色を変える
const navBtn = document.getElementById(`nav-btn${nowPageId}`);
navBtn.style.backgroundColor = '#ccc';

// ナビゲーションボタンを押した時、ページ切り替え
function changePage(pageId) {
  location.href = `/admin/index.php?page=${pageId}`;
}
