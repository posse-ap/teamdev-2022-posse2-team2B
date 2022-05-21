<?php
require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

$pgdata = array();
$pgdata += array('page_title' => 'トップ');

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_input.php');

