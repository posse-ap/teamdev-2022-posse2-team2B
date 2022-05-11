<table border="1" class="list_table">

  <?php foreach (array_map(NULL, $pgdata['table_data']['th'], $pgdata['table_data']['tr']) as [$th, $td]) : ?>
    <tr>
      <th><?= $th; ?></th>
      <td><?= $td; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<a href="../admin/student-delete.php?id=<?= $_GET["id"]; ?>" >この学生情報を削除</a>
