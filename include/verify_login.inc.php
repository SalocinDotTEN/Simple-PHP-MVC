<?php
	/*
		Based on Cassandra Cluster Admin by Sébastien Giroux
		Modified by Salocin.TEN
	*/
	
	if (CCA_LOGIN_REQUIRED && (!isset($_SESSION['cca_login']) || $_SESSION['cca_login'] !== md5(CCA_USERNAME.CCA_PASSWORD))) {
		redirect('login.php?you_must_be_logged=1');
	}
?>