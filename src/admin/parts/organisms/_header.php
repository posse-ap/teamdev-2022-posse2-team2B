<div class="parts">
  <header class="header">
    <h1 class="header__title">CRAFT by boozser</h1>
    <?php if (isset($pgdata['account_name'])) : ?>
      <p>ログイン中: <?= $pgdata['account_name']; ?> 様 (<?= $pgdata['right_name']; ?>アカウント)</p>
    <?php endif; ?>
  </header>
  <div class="header_spacer"></div>
</div>
