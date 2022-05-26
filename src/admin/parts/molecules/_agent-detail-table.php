<form method="post" action="/admin/agent-change.php?id=<?= $_GET["id"]; ?>">
  <table border="1" class="list_table">
    <?php foreach (array_map(NULL, $pgdata['table_data']['th'], $pgdata['table_data']['tr'], array_keys($pgdata['table_data']['tr'])) as $index => [$th,  $td, $key]) : ?>
      <tr>
        <th><?= $th; ?></th>
        <td><input type="text" value="<?= $td; ?>" name="<?= $key; ?>" class="input_change"></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <p>エージェント情報の書き換えを直接行うことが可能です。<br>変更後、下の「上記の内容に変更」ボタンを押してください。</p>

  <a href=""><input value="上記の内容に変更" type="submit" class="btn detail-btn"></input></a>
</form>
