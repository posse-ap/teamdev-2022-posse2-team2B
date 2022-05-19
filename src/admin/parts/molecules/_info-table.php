<table border="1" class="info_table">
  <?php foreach ($pgdata['info_table']['tr'] as $key => $value) : ?>
  <tr>
    <th><?= $key; ?></th>
    <td><?= $value; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
