<table border="1">
  <?php foreach ($pgdata['info_table']['tr'] as $key => $value) : ?>
  <tr>
    <td><?= $key; ?></td>
    <td><?= $value; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
