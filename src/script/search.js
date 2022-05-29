function tagClick(tagId) {
  const tag = document.getElementById(`searchTag${tagId}`);
  const label = document.getElementById(`searchTagLabel${tagId}`);
  if (tag.checked === true) {
    label.classList.add('Search__tag__label-checked');
  } else {
    label.classList.remove('Search__tag__label-checked');
  }
}

// 検索ボタン押した時、チェックされているタグの数によって変える
const searchBtn = document.getElementById('searchBtn');
if (searchBtn !== null) {
  searchBtn.addEventListener('click', () => {
    // チェックされているタグを数える
    let tagCount = 0;
    document.querySelectorAll('.js-tag').forEach(el => {
      if (el.checked) {
        tagCount++;
      }
    });

    if (tagCount === 0) {
      alert('検索条件を指定してください');
    } else {
      document.getElementById('searchForm').submit();
    }
  });
}
