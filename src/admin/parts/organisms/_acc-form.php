<div class="account_form">
  <form action="" id="acc_form" method="POST" autocomplete="off">
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">氏名</h3>
      <div class="account_form__sec__box">
        <input type=" text" name="acc_name" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">メールアドレス</h3>
      <div class="account_form__sec__box">
        <input type=" email" name="email" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">パスワード</h3>
      <div class="account_form__sec__box">
        <input type="password" name="password" id="pw" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">パスワード(確認)</h3>
      <div class="account_form__sec__box">
        <input type="password" name="passwordc" id="pw_again" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">アクセス権限</h3>
      <div class="account_form__sec__box">
        <label class="account_form__sec__box__label">
          <select name="right_id" id="right_select" class="account_form__sec__box__label__select">
            <option value="0" disabled selected>選択してください</option>
            <option value="1">エージェント会社担当者</option>
            <option value="2">共同管理者</option>
            <option value="3">管理者</option>
          </select>
        </label>
      </div>
    </div>

    <div id="agent_select_area" class="account_form__sec">
      <h3 class="account_form__sec__title">エージェントを選択</h3>
      <div class="account_form__sec__box">
        <label class="account_form__sec__box__label">
          <select name="agent_id" id="agent_select" class="account_form__sec__box__label__select">
            <option value="0" disabled selected>選択してください</option>
            <?php foreach ($pgdata['agents'] as $agent) : ?>
              <option value="<?= $agent['id'] ?>"><?= $agent['agent_name'] ?></option>
            <? endforeach; ?>
          </select>
        </label>
      </div>
    </div>

    <input type="hidden" name="action" value="insert">
  </form>
  <?php
  include(dirname(__FILE__) . '/../atoms/_btn.php');
  ?>
</div>
