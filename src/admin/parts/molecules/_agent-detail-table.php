<table border="1" class="list_table">

  <?php foreach (array_map(NULL, $pgdata['table_data']['th'], $pgdata['table_data']['tr']) as [$th, $td]) : ?>
    <tr>
      <th><?= $th; ?></th>
      <td><input type="text" value="<?= $td; ?>"></td>
    </tr>
  <?php endforeach; ?>
</table>
<p>エージェント情報の書き換えを直接行うことが可能です。</p>
<a href="">変更</a>
