<?php
// ヘッダー開始部分
function a_header_start()
{
?>
  <header class="header">
    <div class="header-inner">
    <?php
  }

  // ハンバーガーボタン
  function a_hamburger()
  {
    ?>
      <div class="phone-icon">
        <i class="fa-solid fa-bars"></i>
      </div>
    <?php
  }

  // ヘッダー　ページタイトル
  function a_header_title()
  {
    ?>
      <div class="page-title">
        <a href="">
          <h2>就活.com</h2>
        </a>
      </div>
    <?php
  }

  // ヘッダー検索アイコン
  function a_header_search_icon()
  {
    ?>
      <div class="phone-icon">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>

    </div><!-- header-innerの閉じタグ -->
  <?php
  }

  // ヘッダー上部
  function m_header_upper()
  {
    a_header_start();
    a_hamburger();
    a_header_title();
    a_header_search_icon();
  }

  // ヘッダー ナビゲーション
  function a_header_nav()
  {
  ?>
    <nav class="header-nav">
      <ul class="header-nav-list">
        <li>
          <a href="">就活サイト</a>
        </li>
        <li>
          <a href="">就活支援サービス</a>
        </li>
        <li>
          <a href="">自己分析診断ツール</a>
        </li>
        <li>
          <a href="">ES添削サービス</a>
        </li>
        <li>
          <a href="">就活.comとは</a>
        </li>
        <li>
          <a href="">就活エージェント比較</a>
        </li>
        <li>
          <a href="">お問い合わせ</a>
        </li>
      </ul>
    </nav>
  <?php
  }

  function a_header_end()
  {
  ?>
  </header>
<?php
  }

  // ヘッダー全体
  function o_header()
  {
    m_header_upper();
    a_header_nav();
    a_header_end();
  }

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

  // 使い方カード $file = /pictures/howto/step1.png のようにする
  function a_howto_card($file)
  {
?>
  <div class="How-to__card">
    <img src="<?= 'http://' . $_SERVER['HTTP_HOST'] . $file ?>">
  </div>
<?php
  }

  // 使い方エリア
  function o_howto()
  {
    a_section_start('問い合わせまでの流れ');
?>
  <div>↓使い方の流れのパーツです！</div>
  <div class="How-to">
    <div class="How-to__cards__four">
      <div class="How-to__cards__two">
        <?php
        a_howto_card('/pictures/howto/step1.png');
        a_howto_card('/pictures/howto/step2.png');
        ?>
      </div>
      <div class="How-to__cards__two">

        <?php
        a_howto_card('/pictures/howto/step3.png');
        a_howto_card('/pictures/howto/step4.png');
        ?>

      </div>
    </div>
  </div>
<?php
    a_section_end();
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
?>
  <form action="./result.php" method="POST">
    <?php
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
    ?>
  </form>
<?php
  }

  // エージェントカード
  function a_agent_name($agent_name)
  {
?>
  <div class="agent-card-agent-name">
    <h3><?= $agent_name; ?></h3>
  </div>
<?php
  }

  // エージェントカード エージェント画像 $file = '/pictures/agent1.jpg' のようにする
  function a_agent_img($file)
  {
?>
  <div class="agent-card-image">
    <img src="<?= 'http://' . $_SERVER['HTTP_HOST'] . $file ?>">
  </div>
<?php
  }

  // エージェントカード　タグ
  function a_agent_tag($tag_name)
  {
?>
  <div class="agent-card-tag">
    <?= $tag_name; ?>
  </div>
<?php
  }

  // エージェントカード　タグエリア $tagsはDBから取得した連想配列
  function m_agent_tags($tags)
  {
?>
  <div class="agent-card-tags-area">
    <?php
    foreach ($tags as $tag) {
      a_agent_tag($tag['tag_name']);
    }
    ?>
  </div>
<?php
  }

  // エージェントカード　評価　テーブル列
  function a_agent_eval_tr()
  {
?>
  <tr>
    <td>
      <p>評価項目の変数</p>
    </td>
    <td class="star-evaluation">
      <p>★の数の変数</p>
    </td>
  </tr>
<?php
  }

  // エージェントカード　評価　テーブル
  function m_agent_eval()
  {
?>
  <div class="agent-card-star-evaluation-table">
    <table>
      <?php
      a_agent_eval_tr();
      a_agent_eval_tr();
      ?>
    </table>
  </div>
<?php
  }

  // エージェントカード 紹介文
  function a_agent_intro($agent_intro)
  {
?>
  <div class="argent-card-info-text">
    <p><?= $agent_intro; ?></p>
  </div>
<?php
  }

  // エージェントカード BOX追加ボタン
  function a_agent_putbox_btn($agent_id)
  {
?>
  <div class="put-into-inquiry-box" onclick="putBox(<?= $agent_id; ?>)">
    <p>問い合わせBOXに入れる</p>
  </div>
<?php
  }

  function a_agent_deletebox_btn($agent_id)
  {
?>
  <div class="put-out-of-inquiry-box" onclick="deleteBox(<?= $agent_id; ?>)">
    <p>問い合わせBOXから出す</p>
  </div>
<?php
  }

  function a_agent_detail_btn()
  {
?>
  <div class="view-more-info">
    <p>詳しく見る ></p>
  </div>
<?php
  }

  function m_agent_btns($agent_id)
  {
?>
  <div class="argent-card-btns">
    <?php
    a_agent_putbox_btn($agent_id);
    a_agent_deletebox_btn($agent_id);
    a_agent_detail_btn();
    ?>
  </div>
<?php
  }

  // エージェントカード全体
  function o_agent_card($agent_id, $agent_name, $agent_intro, $tags)
  {
?>
  <article class="agent-card">
    <?php
    a_agent_name($agent_name);
    a_agent_img('/pictures/agent1.jpg');
    m_agent_tags($tags);
    m_agent_eval();
    a_agent_intro($agent_intro);
    m_agent_btns($agent_id);
    ?>
  </article>
<?php
  }

  // エージェントリスト
  function o_agent_list($agents)
  {
    a_section_start('掲載エージェント一覧');

    global $db;
    foreach ($agents as $agent) {
      $tags_stmt = $db->prepare("SELECT * FROM agent_tags LEFT JOIN tags ON agent_tags.tag_id = tags.id WHERE agent_tags.agent_id = ?");
      $tags_stmt->execute([$agent['id']]);
      $tags = $tags_stmt->fetchAll();

      o_agent_card($agent['id'], $agent['agent_name'], $agent['paragraph1'], $tags);
    }

    a_section_end();
  }

  // 再検索 開始
  function a_re_search_start()
  {
?>
  <section class="Re-search">
    <div class="Re-search__ac__parent">
      <p class="">
        再検索
      </p>

    </div>
    <div class="Re-search__ac__child">
    <?php
  }

  // 再検索 中身
  function m_re_search_inner()
  {
    ?>
      <div class="Re-search-tags__ac">
        <div class="Re-search-tags__ac__parent">
          <p class="">XXXから選ぶ</p>
        </div>

        <div class="Re-search-tags__ac__child">
          <div>ここにタグが入る</div>
        </div>
      </div>
    <?php
  }

  // 再検索　終了
  function a_re_search_end()
  {
    ?>
    </div>
  </section>
<?php
  }

  // 再検索　全体
  function o_re_search()
  {
    a_re_search_start();
    m_re_search_inner();
    a_re_search_end();
  }

  // 検索結果 件数
  function a_result_amount()
  {
?>
  <div class="Search-result__message__number">
    <p><span class="Search-result__message__figure">2</span><span class="Search-result__message__unit">件表示</span></p>
  </div>
<?php
  }

  function a_result_tags()
  {
?>
  <div class="Search-result__message__tags">
    <div class="Search-result__message__tag">
      タグ文字変数
    </div>
    <div class="Search-result__message__tag">
      タグ文字変数
    </div>
  </div>
<?php
  }

  function a_result_putall()
  {
?>
  <div class="Search-result__message__check-all">
    <label for="allAgents" class="Search-result__check-all__wrapper">
      <input type="checkbox" id="allAgents" class="Search-result__check-all__checkbox" name="checkbox01">
      <span class="Search-result__check-all__checkbox-icon"></span>
      すべて問い合わせBOXに入れる
    </label>
  </div>
<?
  }

  // 検索結果　先頭
  function m_result_head()
  {
?>
  <div class="Search-result__message">
    <?php
    a_result_amount();
    a_result_tags();
    a_result_putall();
    ?>
  </div>
<?php
  }

  function o_result($agents)
  {
    a_section_start('検索結果');
?>
  <div>
    これは検索結果画面です
  </div>
<?php
    m_result_head();
    o_agent_list($agents);
    a_section_end();
  }

  // 閲覧履歴
  function m_history_item($agent)
  {
?>
  <article class="Agent-card__wrapper__mini">
    <?php
    a_agent_img('/pictures/agent1.jpg');
    a_agent_name($agent['agent_name']);
    ?>
  </article>
<?php
  }

  function o_history($agents)
  {
    a_section_start('閲覧履歴');
?>
  <div>
    これは閲覧履歴エリアです
  </div>
  <?php
    foreach ($agents as $agent) {
      m_history_item($agent);
    }
    a_section_end();
  }

  // エージェント詳細　最終更新
  function a_agent_detail_updated()
  {
  ?>
  <div class="Agent-page__last-update">
    <p>yyyy年mm月dd日</p>
  </div>
<?php
  }

  // エージェント詳細 説明文
  function a_agent_detail_text()
  {
?>
  <div class="Agent-page__text">
    <p>
      これがひとつの見出しに対しての文章になります。テキストだよ。こんにちは。やるか、やるか。これは紹介文になりますよ～。
    </p>
  </div>
<?php
  }

  // エージェント詳細　説明パラグラフ（見出し＋説明文）
  function m_agent_detail_para()
  {
    a_heading_in_section('小見出し');
    a_agent_detail_text();
  }

  // エージェント詳細　全体
  function o_agent_detail($agent_id)
  {
    // セクションの開始
    a_section_start('エージェント詳細');
?>
  <div>
    これはエージェントの詳細ページです
  </div>
  <?php
    // 最終更新日
    a_agent_detail_updated();
  ?>
  <div class="Agent-page__image">
    <?php
    // エージェントの画像
    a_agent_img('/pictures/agent1.jpg');

    // 画像切り替えボタンみたいなやつ
    ?>
  </div>
  <?php
    // ★評価表
    m_agent_eval();
  ?>
  <div class="Agent-page__inquiry-btn">
    <?php
    // 問い合わせボックスに追加ボタン
    a_agent_putbox_btn($agent_id);

    // 問い合わせボックスから出すボタン
    a_agent_deletebox_btn($agent_id);
    ?>
  </div>

  <?php
    // 小見出しと紹介文
    m_agent_detail_para();

    // セクションの終わり
    a_section_end();
  ?>
  <!-- このあとには、閲覧履歴がくる。テンプレートつくる時にはひっぱってこよう！ -->
<?php
  }

  function a_box_deletebtn()
  {
?>
  <div class="Application__box__trash">
    <i class="fa-solid fa-trash-can"></i>
  </div>
<?php
  }

  function m_box_item($agent)
  {
    a_box_deletebtn();
    m_history_item($agent);
  }

  function o_box($agents)
  {
    a_section_start('問い合わせBOX');
?>
  <div>
    ↓これはお問い合わせフォームのページのボックスの中身見せてるところです！
  </div>
<?php
    foreach ($agents as $agent) {
      m_box_item($agent);
    }
    a_section_end();
  }
?>