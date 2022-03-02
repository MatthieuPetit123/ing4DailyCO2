

<?php 
try
{
$mysqlClient = new PDO(
    'mysql:host=localhost;port=3307;dbname=dailyco2;charset=utf8',
    'root',
    'root');
}

catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$login = isset($_POST["login"])? $_POST["login"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";

$sqlQuery = 'SELECT * FROM client';
$selec = $mysqlClient->prepare($sqlQuery);
$selec->execute();
$clients = $selec->fetchAll();

$i = '0';

foreach ($clients as $client)
{
	
	if($nom == $client['nom'] && $prenom == $client['prenom'] && $login == $client['login'] && $mdp == $client['mdp'])
	{
		header('Location: inscription.html');
		$i=$i+1;
	}
}

$sqlQuery = 'INSERT INTO client(nom, prenom, login, mdp) VALUES (:nom, :prenom, :login, :mdp)';
$insertClient = $mysqlClient->prepare($sqlQuery);
$insertClient->execute(['nom'=> $nom,
					'prenom' => $prenom,
					'login' => $login,
					'mdp' => $mdp]);

if($i == '0')
{
	header('location: accueil.html');
}


/*echo $nom;
echo $prenom;
echo $login;
echo $mdp;*/
?>



