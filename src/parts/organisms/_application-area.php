<?php
a_section_start('問い合わせフォーム');
?>

<?php
// 戻るボタン
require(dirname(__FILE__) . "/../atoms/application/_back-button.php");
?>

<div class="Application-form">

  <div>
    これは、申し込みフォームです↓↓↓
  </div>

  <?php


  // お問い合わせ内容 ラジオボタン
  m_heading_required('お問い合せ内容');
  require(dirname(__FILE__) . "/../atoms/application/form-input/_01inquiry-content.php");



  // 名前
  m_heading_required('名前');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_02name.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  // 名前（フリガナ）
  m_heading_required('名前(フリガナ)');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_03name-katakana.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  ?>

  <!-- メールアドレス -->
  <div class="Small-heading__heading-essential">
    <?php
    m_heading_required('メールアドレス');
    ?>
  </div>

  <?php
  require(dirname(__FILE__) . "/../atoms/application/form-input/_04email.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");
  ?>

  <?php

  // 電話番号（半角ハイフンなし）
  m_heading_required('電話番号(ハイフンなし)');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_05tel.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  // 大学名
  m_heading_required('大学名');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_06university.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  // 学部名
  m_heading_required('学部名');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_07faculty.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  // 学科名
  m_heading_required('学科名');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_08department.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  // 卒業年
  m_heading_required('卒業年');

  require(dirname(__FILE__) . "/../atoms/application/form-input/_09graduation-year.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  // 住所
  m_heading_required('住所');
  //   郵便番号
  require(dirname(__FILE__) . "/../atoms/application/form-input/_10mail-number.php");

  require(dirname(__FILE__) . "/../atoms/application/form-input/_example.php");

  //   都道府県
  require(dirname(__FILE__) . "/../atoms/application/form-input/_11prefecture.php");
  //   市区町村番地
  require(dirname(__FILE__) . "/../atoms/application/form-input/_12city.php");
  //   建物名・部屋番号
  require(dirname(__FILE__) . "/../atoms/application/form-input/_13building.php");
  // 自由記述欄
  a_heading('自由記述欄');
  require(dirname(__FILE__) . "/../atoms/application/form-input/_14free.php");

  // プライバシーポリシーの文章
  m_heading_required('プライバシーポリシー');
  require(dirname(__FILE__) . "/../atoms/application/_privacy-policy.php");

  // プライバシーポリシーチェックボックス
  require(dirname(__FILE__) . "/../atoms/application/form-input/_15checkbox-privacy-policy.php");

  //送信ボタン
  require(dirname(__FILE__) . "/../atoms/application/_btn.php");




  ?>


</div>



<?php
a_section_end();
?>
