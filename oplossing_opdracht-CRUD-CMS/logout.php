<?php
	session_start();

	unset($_SESSION['notification']);

	if (isset($_COOKIE['login'])) 
	{
		if (isset($_POST['uitlogLink'])) // enkel uitloggen (cookie wissen),als je ingelogd was, en als je op de uitloglink geklikt hebt
		{
			setcookie('login', '', -3600); //cookie verwijderen
			unset($_SESSION['data']['email']); //anders blijven email en password in de inputvelden vd registratiepagina staan als je daarna naar de registratiepag gaat
			unset($_SESSION['data']['randomPassword']);
			$_SESSION['notification']['logout'] = array('type' => 'text', 'message' => 'U bent uitgelogd, tot de volgende keer.');
			header('Location: login-form.php'); 
		}
		else 	//als je ingelogd bent, maar naar de uitlogpagina gesurft hebt, zonder dus op de uitloglink te drukken --> doorverwijzen naar dashboard
		{
			header('Location: dashboard.php');
		}
	}
	else
	{
		header('Location: login-form.php'); //als je niet ingelogd was --> doorverwijzen naar login form
	}
?>