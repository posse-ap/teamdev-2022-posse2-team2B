<?php

if(!isset($_POST['func']) || !isset($_POST['args'])) {
  exit();
}

include(dirname(__FILE__) . '/../parts/parts.php');

$func = $_POST['func'];
$args = implode(', ', $_POST['args']);
echo $func($args);
