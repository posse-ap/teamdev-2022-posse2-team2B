<?php

if(!isset($_POST['func']) || !isset($_POST['arg'])) {
  exit();
}

include(dirname(__FILE__) . '/../parts/parts.php');

$func = $_POST['func'];
$arg = json_decode($_POST['arg'], true);
$html = '';
foreach($arg as $agent) {
  $html .= $func($agent);
}
echo $html;
