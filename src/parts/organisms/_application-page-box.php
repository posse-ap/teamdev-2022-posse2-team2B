<?php
a_section_start('問い合わせBOX');
?>
<div>
  ↓これはお問い合わせフォームのページのボックスの中身見せてるところです！
</div>
<?php
foreach ($agents as $agent) {
  m_box_item($agent);
}
a_section_end();
