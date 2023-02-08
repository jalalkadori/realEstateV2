<?php include("./connexion.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMMO HORIZON</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>   
    <body>
        <header class="container-fluid bg-dark fixed-top mb-1">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark py-2">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="./logo/black.png" alt="logo" width="120">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-light">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Annonce">Annonces</a>
                                </li>
                                <li class="nav-item">
                                    <a tupe"button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#AjoutModal"> + Ajouter une Annonce</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        
        <main class="container-fluid pt-5">
            <section class="container pt-5">
                <h2 class="pt-5">Filtrer la liste des annonces !</h2>
                <form class="row row-cols-lg-3" action="#">
                    <div class="col">
                        <h5 for="type">Categorie</h5>
                        <select class="form-select" aria-label="type">
                            <option value="Location">Location</option>
                            <option value="Vente">Vente</option>
                        </select>
                    </div>

                    <div class="col">
                        <h5>Prix : </h5>
                        <div class="d-flex gap-1">
                            <input type="number" class="form-control" placeholder="Min" aria-label="Min" min="0">
                            <input type="number" class="form-control" placeholder="Max" aria-label="Max" min="0">
                        </div>
                    </div>
                    
                    <div class="col d-flex align-items-end">
                        <button class="btn btn-dark">Chercher</button>
                    </div>
                </form>
            </section>

            <section class="container mt-5" id="Annonce">
                <h2>Liste des Annonces disponible : </h2>
                <?php
                    //*****prob il affiche  les cartes verticalement

                    
                    if($count > 0 ){
                        echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mt-5'>";
                        while ($ligne = $rest->fetch(PDO::FETCH_ASSOC)) {
                            $idAnn = $ligne["IdAnnonce"] ;
                            // echo $idAnn;
                            echo("
                                <div class='col mt-2'>
                                    <div class='card'>
                                        <img src='".$ligne["ImageAnnonce"]."' class='card-img-top' alt='app'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>".$ligne["TitreAnnonce"]." à Louer de ".$ligne["SuperficieAnnonce"]." m²</h5>
                                            <div class='d-flex justify-content-between align-items-center'>
                                                <h5 class='text-danger fs-3'>".$ligne["MontantAnnonce"]." DH</h5>
                                            </div>
                                            <p class='card-text'>".$ligne["AdresseAnnonce"]."</p>
                                            <p class='card-text'>Publié le ".$ligne["DateAnnonce"].".</p>
                                            <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#ModificationModal'>Modifier</button>
                                            <button class='btn btn-danger' name='suppBtn' value='".$ligne["IdAnnonce"]."' data-bs-toggle='modal' data-bs-target='#Suppression'>Supprimer</button>
                                        </div>
                                    </div>
                                </div>"
                            );
                            
                            
                        } 

                        echo "</div>";
                        if(isset($_POST['suppBtn'])){

                            echo '
                            <div class="modal fade" id="Suppression" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">'.$_POST['suppBtn'].'</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                            // $delete = $dbco->prepare("DELETE FROM `annonce` WHERE `annonce`.`IdAnnonce` =".$_POST['suppBtn']);
                            // $delete->execute();

                            // if($delete->rowCount()) {
                            //     echo 'row deleted';
                            // } else {
                            //     echo 'error';
                            // }
                        }


                        
                    }
                   
                   
                 ?>

                
                <!-- Ajout Modal -->
                <div class='modal fade' id='AjoutModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Ajouter une nouvelle annonce</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form action='' method='POST'>
                                <div class='mb-3'>
                                    <label for='titre' class='form-label'>Titre d'annonce :</label>
                                    <input type='text' class='form-control' id='titre' name='titre1'>
                                </div>
                                <div class='mb-3'>
                                    <label for='image' class='form-label'>Chemin d'image: </label>
                                    <input type='text' class='form-control' id='image' name='image'>
                                </div>
                                <div class='mb-3'>
                                    <label for='Description' class='form-label'>Description : </label>
                                    <textarea type='text' class='form-control' id='Description' name='description'></textarea>
                                </div>
                                <div class='mb-3'>
                                    <label for='Adresse' class='form-label'>Adresse : </label>
                                    <input type='text' class='form-control' id='Adresse' name='adresse'>
                                </div>
                                <div class='row mb-3'>
                                    <div class='col'>
                                        <label for='Superficie' class='form-label'>Superficie : </label>
                                        <input type='number' class='form-control' id='Superficie' name='superficie'>
                                    </div>
                                    <div class='col'>
                                        <label for='Montant' class='form-label'>Montant : </label>
                                        <input type='number' class='form-control' id='Montant' name='montant'>
                                    </div>
                                    <div class='col'>
                                        <label for='date' class='form-label'>Date : </label>
                                        <input type='date' class='form-control' id='date' name='date'>
                                    </div>
                                </div>
                                <div class='mb-3'>
                                    <label for='Type' class='form-label'>Type d'annonce : </label>
                                    <select class='form-select' aria-label='type' id='Type' name='type'>
                                        <option value='Location'>Location</option>
                                        <option value='Vente'>Vente</option>
                                    </select>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-dark w-100' name='ajouter'>Ajouter</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                if(isset($_POST['ajouter'])){//lorsque je clik sur le bouttant ajouter
                    $titre =$_POST["titre1"];
                    $img = $_POST["image"];
                    $desc = $_POST["description"];
                    $sup =$_POST["superficie"];
                    $add = $_POST["adresse"];
                    $montant = $_POST["montant"];
                    $date = $_POST["date"];
                    $type = $_POST["type"];

                    $requeteAjout = "INSERT INTO `annonce` (`TitreAnnonce`, `ImageAnnonce`, `DescriptionAnnonce`, `SuperficieAnnonce`, `AdresseAnnonce`, `MontantAnnonce`, `DateAnnonce`, `TypeAnnonce`) VALUES ('$titre', '$img', '$desc', '$sup', '$add','$montant', '$date', '$type')"; // il faut qelle soit ici et pas dans l'autre fichier
                    $dbco->exec($requeteAjout);
                }
                 ?>

                
                            
                <!-- Modification Modal -->
                <div class='modal fade' id='ModificationModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Modification de l'annonce N°</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form action='index.php' method='POST'>
                                <div class='mb-3'>
                                    <label for='titre' class='form-label'>Titre d'annonce :</label>
                                    <input type='text' class='form-control' id='titre' name='titre'>
                                </div>
                                <div class='mb-3'>
                                    <label for='image' class='form-label'>Chemin d'image: </label>
                                    <input type='text' class='form-control' id='image' name='image'>
                                </div>
                                <div class='mb-3'>
                                    <label for='Description' class='form-label'>Description : </label>
                                    <textarea type='text' class='form-control' id='Description' name='description'></textarea>
                                </div>
                                <div class='mb-3'>
                                    <label for='Adresse' class='form-label'>Adresse : </label>
                                    <input type='text' class='form-control' id='Adresse' name='adresse'>
                                </div>
                                <div class='row mb-3'>
                                    <div class='col'>
                                        <label for='Superficie' class='form-label'>Superficie : </label>
                                        <input type='number' class='form-control' id='Superficie' name='Superficie'>
                                    </div>
                                    <div class='col'>
                                        <label for='Montant' class='form-label'>Montant : </label>
                                        <input type='number' class='form-control' id='Montant' name='Montant'>
                                    </div>
                                    <div class='col'>
                                        <label for='Adresse' class='form-label'>Date : </label>
                                        <input type='date' class='form-control' id='Date' name='date'>
                                    </div>
                                </div>
                                <div class='mb-3'>
                                    <label for='Type' class='form-label'>Type d'annonce : </label>
                                    <select class='form-select' aria-label='type' id='Type' name='type'>
                                        <option value='Location'>Location</option>
                                        <option value='Vente'>Vente</option>
                                    </select>
                                </div>
                            
                        </div>
                        <div class='modal-footer'>
                            <button type='submit' class='btn btn-success' name='modifier'>Modifier</button>
                        </div>
                        </form>
                        <?php 
                        if(isset($_POST["modifier"])){
                            
                        }
                        ?>
                        </div>
                    </div>
                </div>
               
            </section>

            
        </main>






        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    </body>
</html>