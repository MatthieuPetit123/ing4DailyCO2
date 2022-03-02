<?php

try
{
	$mysqlClient = new PDO('mysql:host=localhost;port=3307;dbname=dailyco2;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$login = isset($_POST["login"])? $_POST["login"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";


$sqlQuery = 'SELECT * FROM client';
$selec = $mysqlClient->prepare($sqlQuery);
$selec->execute();
$clients = $selec->fetchAll();

$i = '0';

foreach ($clients as $client)
{
	
	if($login == $client['login'] && $mdp == $client['mdp'])
	{
		header('Location: accueil.html');
		$i=$i+1;
	}
}

if($i=='0')
{
	
	header('Location: connexion.html');
}

?>  