<div class="nav-spacer"></div>
<div class="side-bar">
  <table>
    <?php foreach ($pages as $page) : ?>
      <tr>
        <td id="nav-btn<?= $page['page_id']; ?>" onclick="changePage(<?= $page['page_id']; ?>)"><?= $page['page_name']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
