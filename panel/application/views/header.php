<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('html');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<!-- Bootstrap core CSS -->
	<?php echo link_tag('css/bootstrap.min.css'); ?>
	<?php echo link_tag('css/custom.css'); ?>
	
	<title><?php echo $title ?></title>
	
</head>
<body>