<?php 
if (isset($_POST["btn"])) {
	// creation des variables de stock
@$nom=$_POST['nom'];
@$prix=$_POST['prix'];
@$description=$_POST['descr'];
@$photos=$_FILES['photos'];
	// recupration des photos
$source=$photos['tmp_name'];
$destination=$photos['name'];
foreach ($photos['tmp_name'] as $key => $value) {
	move_uploaded_file($source[$key], $destination[$key]=$nom.$key.'.png');
}
	$bd=new PDO('mysql:host=localhost;dbname=produits;charset=utf8','root','');
	$insert=$bd->prepare('INSERT INTO `produit`(`nom_produit`,`prix`,`description`,`photos`) VALUES(?,?,?,?)');
	$insert->execute(array($nom,$prix,$description,implode(",",$destination)));


	if ($bd) {
	echo "
	<h2>Produit ajouter avec succe</h2>";
}
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>ajouter des produits</title>
	<style type="text/css">
		form{
			margin: auto;
			margin-top: 6%;
		}
	</style>
</head>
<body class="container">
<form class="col-lg-6" name="form" method="post" enctype="multipart/form-data" >
		<h2>Ajouter un produit</h2>	
	<div class="form-group">
		<label>Nom du produit : </label>
		<input type="text" class="form-control" name="nom">
	</div>
		<label>Prix du produit : </label>
		<input type="number" class="form-control" name="prix">
	<div class="form-group">
		<label>Desciption du produit : </label>
		<textarea  class="form-control" name="descr"></textarea>
	</div>
		<label>ajouter une photo : </label>
		<input type="file" class="form-control" multiple name="photos[]">
	<div class="form-group"><br/>
		<input type="submit" class="btn btn-success" name="btn" value="valider" >
	</div>

</form>
</body>
</html>