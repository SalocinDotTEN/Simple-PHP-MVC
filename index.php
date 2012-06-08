<?php
	/*
		Based on Cassandra Cluster Admin by Sébastien Giroux
		modified by Salocin.TEN
	*/
	
	require('include/kernel.inc.php');
	require('include/verify_login.inc.php');
	
	/*
		Display success message
	*/
	$vw_vars['success_message'] = '';
	
	if (isset($_GET['success_message'])) {
		$success_message = $_GET['success_message'];		
	}	
	
	/*
		Display error message
	*/
	$vw_vars['error_message'] = '';
	
	if (isset($_GET['error_message'])) {
		$error_message = $_GET['error_message'];
	}	
	
	echo getHTML('header.php');
	//include('cluster_info.php');
	echo getHTML('footer.php');
?>