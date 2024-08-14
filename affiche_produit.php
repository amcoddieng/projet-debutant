<?php 
session_start();
	$bd=new PDO('mysql:host=localhost;dbname=produits;charset=utf8','root','');
	$donnee=$bd->query('SELECT *FROM produit');
	$resultats=$donnee->fetchAll();

    if (@$_GET['sup']) {
        $prepareSup=$bd->prepare('DELETE FROM produit WHERE id_produit=?');
        $prepareSup->execute(array($_GET['sup']));
        header('location:affiche_produit.php');
    }
   if ($_SESSION['zzzz'] == "echec") {
       header('location:ajout_produit.php');
   }
    echo "<h2 style='color:red'>Votre connexion est reussi : ".$_SESSION['prenom']."&nbsp".$_SESSION['nom']."</h2>";

 ?>

<!DOCTYPE html>
<html lang="en">
<div>

    
    <br><br><br><br><br><br>
</div>
<script type="text/javascript">
    


// var lis = document.querySelectorAll('li');
//         lis.style.color='red';
//         lis.addEventListener('mouseover',function(){
//         document.getElementById('search').value=this.value;
//         })

</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Web Bootstrap</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<style type="text/css">
    html{
        font-size: 90%;
    }
	.imm{
      height: 160px;
      width: 160px;
      margin-left:16%;
      border-radius: 50px;
      border:0.1px cadetblue solid ;
    }
    .col-md-3:hover{
/*        border-top: 3px green solid;*/
        border-radius: 10px;
        background-color: cadetblue;

    }
    #results {
            border: 1px solid #ccc;
            max-width: 200px;
            margin-top: 10px;
            float: right;
        }
        .result-item {
/*            padding: 10px;*/
/*            border-bottom: 1px solid #eee;*/
        }
</style>
<body class="container">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> 
      <a class="navbar-brand" href="#">Mes Produits</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">À Propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
             </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
        
      <input type="text" id="search" placeholder="Rechercher...">

    </nav>
    <div class="container" id="results"></div>

    <script >
        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search').addEventListener('keyup', function() {
                var query = this.value;
                if (query.length > 0) {






                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'serverAjax.php?search=' + encodeURIComponent(query), true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById('results').innerHTML = xhr.responseText;
                          

                          var lis = document.querySelectorAll(' li');
                            for (var i = 0; i < lis.length; i++) {
                                lis[i].style.cursor = 'pointer';
                                lis[i].addEventListener('mouseover', function() {
                                    this.style.color = 'black';
                                    this.style.backgroundColor = 'DimGray';
                                    this.style.fontWeight = 'bold';
                                    document.getElementById('search').value = this.textContent;
                                });
                                lis[i].addEventListener('mouseout', function() {
                                    this.style.color = '';
                                    this.style.backgroundColor = '';
                                    this.style.fontWeight = '';
                                });
                            }
            
    
  
                        }
                    };
                    xhr.send();
                    // document.getElementById('cont_principal').style.display = 'none';
                } else {
                    document.getElementById('results').innerHTML = '';
                    document.getElementById('cont_principal').style.display = 'contents';
                }
            });
        });
    </script> 


    <div class="container" id="cont_principal">
        <h1>Les produits disponibles</h1>
       		<?php 
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
      
       		 ?>
</div>




</body>
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container text-center">
            <span>© 2024 Mes Produits. Tous droits réservés.</span>
        </div>
    </footer>

</html>
