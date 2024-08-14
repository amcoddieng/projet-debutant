<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body id="contenu">
<!-- <h2>Resultats de Recherche ...</h2> -->
</body>
<?php
echo "
";
$host = 'localhost';
$db   = 'produits';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $pdo->prepare('SELECT * FROM produit WHERE nom_produit LIKE ? OR description LIKE ?');
    $stmt->execute(["%$search%", "%$search%"]);
    $resultats = $stmt->fetchAll();
    // RESULTATS EN LI
    //  if ($resultats) {
    // 	echo "
 

    // 	<ul>";
    // 	foreach ($resultats as $resultat) { 
    // 		echo "
    // 				<li>".$resultat['nom_produit']."</li>";
    		
    // 	}

    // }else{
    // 	echo "<h4 style='color: red;'>Aucun resultat</h4>";
    // }


    if ($resultats) {
        echo "<div class='card-group'>";
       			foreach ($resultats as $resultat) {
       				$e=array(explode(",",$resultat['photos']));
       				echo "
       		  <div class='col-md-3 p-4'>
    <img class='imm' class='card-img-top' src='".$e[0][0]."' alt='Card image cap'>
    <div class='card-body'>
      <h5 class='card-title text-center'>".$resultat['nom_produit']."</h5>
      <h5 class='card-title text-center'>".$resultat['prix']." FCFA</h5>
      <p class='card-text text-center'>".$resultat['description']."</p>
      <p class='card-text text-center'>
         <button class='btn btn-success'>
          <svg xmlns='http://www.w3.org/2000/svg' width='25' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7'/>
</svg></button>
        <a href='affiche_produit.php?sup=".$resultat['id_produit']."' class='btn btn-danger'>
          <svg xmlns='http://www.w3.org/2000/svg' width='25' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
  <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
</svg></a>
        <button class='btn btn-warning'>
        <svg xmlns='http://www.w3.org/2000/svg' width='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
</svg></button>
       </p>
      
    </div>
  </div>
"	;
       			}
      echo "</div>";
    } else {
        echo '<div class="result-item">Aucun résultat trouvé</div>';
    }
}




?>

</html>