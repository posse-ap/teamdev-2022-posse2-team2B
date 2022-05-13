<div class="agent-card-tags-area">

  <?php
  foreach ($tags as $tag) {
    $tag_name = $tag['tag_name'];
    include(dirname(__FILE__) . '/../../atoms/agent-card/_agent-tag.php');
  }
  ?>

</div>
