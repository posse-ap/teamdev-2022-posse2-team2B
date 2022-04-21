<?php
$account_stmt = $db->prepare("SELECT name FROM accounts WHERE id = ?");
$account_stmt->execute([$_SESSION['account_id']]);
$pgdata['account_name'] = $account_stmt->fetch()['name'];
