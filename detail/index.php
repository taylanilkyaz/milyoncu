<?php
require $_SERVER['DOCUMENT_ROOT'].'/system-header.php';
require 'Detail.php';
global $debugHelper;

$home = new Detail();
getHeader();

require 'detail-form.php';

?>