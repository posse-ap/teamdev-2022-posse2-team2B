<table border="1">
  <tr>
    <?php foreach ($pgdata['table_data']['th'] as $th) : ?>
      <th><?= $th; ?></th>
    <?php endforeach; ?>
  </tr>

  <?php foreach ($pgdata['table_data']['tr'] as $tr) : ?>
    <tr>
      <?php foreach ($tr as $td) : ?>
        <td><?= $td; ?></td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
</table>
