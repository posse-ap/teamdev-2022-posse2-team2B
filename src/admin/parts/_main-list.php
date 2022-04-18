<div class="content-wrapper">
  <div class="main-column-area">
    <table class="c-table">
      <tr>
        <?php foreach ($page_cols as $page_col) : ?>
          <th><?= $page_col['col']; ?></th>
        <?php endforeach; ?>
      </tr>
      <?php foreach ($data as $row) : ?>
        <tr>
          <?php foreach ($row as $d) : ?>
            <td><?= $d; ?></td>
          <?php endforeach; ?>
          <td><a href="">詳細</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
