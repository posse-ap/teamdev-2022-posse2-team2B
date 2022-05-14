function tagClick(tagId) {
  const tag = document.getElementById(`searchTag${tagId}`);
  const label = document.getElementById(`searchTagLabel${tagId}`);
  if (tag.checked === true) {
    label.classList.add('Search__tag__label-checked');
  } else {
    label.classList.remove('Search__tag__label-checked');
  }
}

