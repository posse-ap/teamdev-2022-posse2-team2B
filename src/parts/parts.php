<?php
// セクション開始部分 a_section_end()とセットで使う
function a_section_start($section_title)
{
?>
  <section class="Section">
    <div class="Section__title">
      <p>
        <?php if (isset($section_title)) {
          echo $section_title;
        } else {
          echo '$section_titleを定義してください';
        } ?>
      </p>
    </div>
    <div class="Section__content">
    <?php
  }

// セクション終了部分
  function a_section_end()
  {
    ?>
    </div>
  </section>
<?php
  }

// セクション内小見出し
  function a_heading_in_section($title)
  {
?>
  <div class="Section__inner-heading">
    <p class=""><?= $title; ?></p>
  </div>
<?php
  }

  // セクション内小見出し(問い合わせフォーム用)
  function a_heading($title)
  {
?>
  <div class="Small-heading__heading">
    <p class=""><?= $title; ?></p>
  </div>
<?php
  }

  // 「必須」マーク
  function a_required_mark()
  {
?>
  <div class="Small-heading__essential-mark">
    <p>必須</p>
  </div>
<?php
  }

  // セクション内小見出し、「必須」マーク付き
  function m_heading_required($title)
  {
?>
  <div class="Small-heading__heading-essential">
    <?php
    a_heading($title);
    a_required_mark();
    ?>
  </div>
<?php
  }

  // 検索条件タグ
  function a_tag($tag)
  {
?>
  <div class="Search__tag__wrapper">
    <div class="Search__tag">
      <label class="Search__tag__label" id="searchTagLabel<?= $tag['id']; ?>" for="searchTag<?= $tag['id']; ?>"><?= $tag['tag_name']; ?></label>
      <input type="checkbox" name="tags[]" value="<?= $tag['id']; ?>" class=" Search__tag__input" id="searchTag<?= $tag['id']; ?>" onclick="tagClick(<?= $tag['id']; ?>)">
    </div>
  </div>
<?php
  }

  // 検索条件小見出し（タグカテゴリ）とタグのかたまり
  function m_tags_sec($tag_category, $tags)
  {
    a_heading_in_section($tag_category['tag_category_name']);
    foreach ($tags as $tag) {
      a_tag($tag);
    }
  }

  // 検索ボタン
  function a_search_btn()
  {
?>
  <div class="Search__btn">
    <button name="search">
      <i class="fa-solid fa-magnifying-glass"></i><span>検索</span>
    </button>
  </div>
<?php
  }

  // 検索エリア全体
  function o_search_area($tag_categories)
  {
    a_section_start('条件絞り込み');

?>
  <div>
    <p>※すべて複数選択可能</p>
  </div>
<?php
    global $db;
    foreach ($tag_categories as $tag_category) {
      $tags_stmt = $db->prepare("SELECT * FROM tags WHERE tag_category_id = ?");
      $tags_stmt->execute([$tag_category['id']]);
      $tags = $tags_stmt->fetchAll();
      m_tags_sec($tag_category, $tags);
    }

    a_search_btn();

    a_section_end();
  }
?>
