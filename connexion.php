<?php session_start();
function bd(){
	$dataBase= new PDO('mysql:host=localhost;dbname=produits;charset=utf8','root','');
	return $dataBase;
}
if (isset($_POST['sudmit'])) {
	$email=$_POST['email'];
	$mdp=$_POST['mdp'];

	 	$bd=bd();
	 	$prepare=$bd->prepare('SELECT * FROM users WHERE email=? AND moDetPasse=?');
	 	$prepare->execute(array($email,$mdp));
	 	$tttt=$prepare->fetch();
	 	if ($prepare->rowCount()>0) {
	 		
	 		$_SESSION['connexion']="reussi";
	 		$_SESSION['email']=$email;
	 		$_SESSION['nom']=$tttt['nom'];
	 		$_SESSION['prenom']=$tttt['Prenom'];
	 		header('location:affiche_produit.php');
	 	}else{
	 		$_SESSION['zzzz']="echec";
	 		header('location:connexion.php');
	 	}
	 }


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form method="post" action="" name="log">
	<label>email</label>
	<input type="email" name="email"><br><br>
	<label>mot de passe</label>
	<input type="password" name="mdp">
	<input type="submit" name="sudmit">
</form>
</body>
</html>