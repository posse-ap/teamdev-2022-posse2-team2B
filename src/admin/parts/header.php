<header>
  <h1>CRAFT by boozser</h1>
  <?php if(isset($account_name)) : ?>
  <p>ログイン中: <?= $account_name; ?> 様 (<?= $role; ?>アカウント)</p>
  <?php endif; ?>
</header>
<div class="header_spacer"></div>
