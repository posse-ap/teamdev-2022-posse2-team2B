<?php
$name = $pgdata['account']['name'];
$email = $pgdata['account']['email'];
$right_id = $pgdata['account']['right_id'];
$this_agent_id = $pgdata['account']['agent_id'];

function addSelected($value, $id)
{
  if ($value == $id) {
    return 'selected';
  } else {
    return '';
  }
}
?>

<div class="account_form">
  <form action="" method="POST" id="acc_form" autocomplete="off">
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">氏名</h3>
      <div class="account_form__sec__box">
        <input type="text" name="acc_name" required value="<?= $name; ?>">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">メールアドレス</h3>
      <div class="account_form__sec__box">
        <input type="email" name="email" required value="<?= $email; ?>">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">新規パスワード</h3>
      <div class="account_form__sec__box">
        <input type="password" name="password" id="pw" required autocomplete="new-password">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">新規パスワード(確認)</h3>
      <div class="account_form__sec__box">
        <input type="password" name="passwordc" id="pw_again" required autocomplete="new-password">
      </div>
    </div>

    <div class="account_form__sec" class="account_form__sec">
      <h3 class="account_form__sec__title">アクセス権限</h3>
      <div class="account_form__sec__box">
        <label class="account_form__sec__box__label">
          <select name="right_id" id="right_select" class="account_form__sec__box__label__select">
            <option value="1" <?= addSelected(1, $right_id); ?>>エージェント会社担当者</option>
            <option value="2" <?= addSelected(2, $right_id); ?>>共同管理者</option>
            <option value="3" <?= addSelected(3, $right_id); ?>>管理者</option>
          </select>
        </label>
      </div>
    </div>
    
    <div id="agent_select_area" class="account_form__sec">
      <h3 class="account_form__sec__title">エージェントを選択</h3>
      <div class="account_form__sec__box">
        <label class="account_form__sec__box__label">
          <select name="agent_id" id="agent_select" class="account_form__sec__box__label__select">
            <?php foreach ($pgdata['agents'] as $agent) : ?>
              <option value="<?= $agent['id'] ?>" <?= addSelected($agent['id'], $this_agent_id); ?>><?= $agent['agent_name'] ?></option>
            <? endforeach; ?>
          </select>
        </label>
      </div>
    </div>

    <input type="hidden" name="action" value="update">
  </form>
  <?php
  include(dirname(__FILE__) . '/../atoms/_btn.php');
  ?>
</div>
