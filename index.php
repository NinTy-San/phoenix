<?php
require_once 'inc/init.inc.php';


//  -------------------_/*\_---Carousel---_/*\_-------------------
$query = $pdo->query("SELECT * FROM voyage");
$caroussel ='';

while ($voyage = $query->fetch(PDO::FETCH_ASSOC)){
    if(empty($caroussel)){
        $caroussel .= '<div class="carousel-item active">';
        $caroussel .= '<img class="d-block w-100 img-fluid" src="'. $voyage['photo'] .'" alt="'. $voyage['destination'] .'">';
        $caroussel .= ' </div>';
    } else {
        $caroussel .= '<div class="carousel-item ">';
        $caroussel .= '<img class="d-block w-100 img-fluid" src="'. $voyage['photo'] .'" alt="'. $voyage['destination'] .'">';
        $caroussel .= ' </div>';
    }
}

//  -------------------_/*\_---Cards---_/*\_-------------------
$query = $pdo->query("SELECT * FROM voyage");
$cards = '' ;

while ($voyage = $query->fetch(PDO::FETCH_ASSOC)){
    $cards .= '<div class="col-md-4 mt-5">';
    $cards .= '<div class="card border-info position-relative" style="width: 22rem; height:425px;">'; 
    $cards .= '<img class="card-img-top" src="'. $voyage['photo'] .'" alt="'.$voyage['destination'].'">'; 
    $cards .= '<div class="card-body position-absolute h-50 bg-white" style="bottom:0; font-size: 1rem;"> '; 
    $cards .= '<h5 class="card-title text-center text-bold">'.$voyage['destination'].'</h5>';
    $cards .= '<p class="card-text">'. $voyage['presentation'] .'</p>';
    $cards .= '<a href="?page=reserver&&id_voyage='.$voyage['id_voyage'].'" class="btn btn-outline-info btn-block w-100">Réserver maintenant !</a>';
    $cards .= '</div>';
    $cards .= '</div>';
    $cards.= '</div>';
}


//  -------------------_/*\_---thumbnails---_/*\_-------------------
$query = $pdo->query("SELECT * FROM voyage");
$thumbnails = '' ;

while ($voyage = $query->fetch(PDO::FETCH_ASSOC)){
    $thumbnails .= '<img class="img-thumbnail" src="'. $voyage['photo'] .'" alt="'.$voyage['destination'].'" style="width: 150px;">'; 
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoenix</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="container-fluid">
<!-- |--------------------------------------| Page principale |--------------------------------------| -->
   
<?php if (!$_GET){ ?>
    <div class="row fixed-top">
        <div class="col-12 col-md-12 ">
<?php } else {?>
    <div class="row mb-3">
        <div class="col-12 col-md-12 ifNotHomeNav">
<?php }?>
            <nav class="navbar navbar-expand-lg offset-md-3">
                <a class="navbar-brand text-body" href="index.php"><i class="fab fa-phoenix-framework"></i></a>
                <a class="navbar-brand text-body"  href="index.php">Phoenix</a>
                <a class="nav-link text-dark" href="?page=choix">Choisir une destination</a>
                <!-- <a class="nav-link text-dark disabled" href="">Payer</a> -->
            </nav>
        </div> <!-- Fin col nav -->
    </div> <!-- Fin row nav -->



<!-- If $Get -->
    <?php if ($_GET) { ?>
    <div class="container">
<?php }?>
        <div class="row mt-5 mb-5">
            <div class="col-md-12 p-0">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
<?php if(!$_GET){?>
                    <div class="carousel-inner" style="height: 85vh;">
<?php } else {?>
                    <div class="carousel-inner" style="height: 40vh;">
<?php }
    echo $caroussel;
?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div> <!-- Fin col caroussel -->
        </div> <!-- Fin row caroussel -->

<?php if (!$_GET) { ?>
        <div class="row mb-2">
            <div class="col-md-8 offset-md-2">
                <a href="?page=choix" class="btn btn-outline-info btn-block w-100">Choisir mon séjour tout de suite !</a>
            </div>
        </div> <!-- btn choisir -->    
<?php }?> 
<!-- fin haut de page -->

<!-- |--------------------------------------| Page choix |--------------------------------------| -->
<?php if (!empty($_GET) && $_GET['page'] == 'choix' ){ ?>     
       <div class="row mt-5 mb-5">
           <?php echo $cards; ?>
       </div> <!--fin .row cards -->
<?php } ?>

<!-- |--------------------------------------| Page resevation |--------------------------------------| -->    

<?php if ((!empty($_GET) && $_GET['page'] == 'reserver') && empty($_POST)){ 
$query = $pdo->query("SELECT * FROM voyage WHERE id_voyage = '$_GET[id_voyage]'"); 
$cards_form = $query->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card border-info " style="width: 22rem;">
                    <img class="card-img-top" src="<?php echo $cards_form['photo']?>" alt="<?php echo $cards_form['destination']?>">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo $cards_form['destination']?></h5>
                    </div>
                    <div class="card-footer alert-info">
                        <p class="card-text text-info">1 Semaine / personne : <?php echo $cards_form['prix']?></p>
                    </div>
                </div><!--fin .card -->
            </div>
            <div class="col-md-8">
                <div class="card border-info h-100" >
                    <div class="card-header alert-info h-25">
                        <p class="card-text text-info" style="font-size:1.7rem">Je complète mes informations de reservation<i class="fab fa-phoenix-framework"></i></p>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row mt-2 mb-5">
                                <div class="col">
                                    <input id="id_voyage" name="id_voyage" type="hidden" value="<?php echo $_GET['id_voyage']?>">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email de confirmation" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <input type="text" name="nb_semaines" id="nb_semaines" class="form-control" placeholder="Je pars combien de semaine ?" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="nb_vacanciers" id="nb_vacanciers" class="form-control" placeholder="Nombre de vacanciers" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-block w-100 mt-5">Confirmer ma reservation</button>
                        </form>
                    </div>
                </div><!--fin .card -->
            </div><!--fin .col -->
        </div><!--fin .row -->


        <!-- thumbnails -->
        <div class="row mt-5 mb-5">
            <div class="col-md-12 mt-5">
                <div class="d-flex flex-row justify-content-around">    
                    <?php echo $thumbnails; ?>
                </div>
            </div>
       </div> <!--fin .row thumbnails -->

<?php } ?>

<!-- |--------------------------------------| Page resevation |--------------------------------------| -->    
       <?php if (!empty($_POST)){
           
    //     echo '<pre>';
    //        echo var_dump($_POST);
    //    echo '</pre>';

    $query = $pdo->query("SELECT prix FROM voyage WHERE id_voyage = '$_GET[id_voyage]'"); 
    $prixStr = $query->fetch(PDO::FETCH_ASSOC);

    $prix = array_map( 'intval', $prixStr);
    $detail = detail($_POST, $prix['prix']);

    //    echo '<pre>';
    //        echo var_dump($detail);
    //    echo '</pre>';
       ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">Recapitulatif de votre commande </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="alert alert-warning">Participant(s)</div>        
            </div>
            <div class="col-md-4">
                <div class="alert alert-warning"><?php echo $detail['nb_vacanciers']; ?></div>
            </div>
        
            <div class="col-md-2">
                <div class="alert alert-success">Commande</div>        
            </div>
            <div class="col-md-4">
                <div class="alert alert-success"><?php echo $detail['email']; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="alert alert-warning">Semaine(s)</div>        
            </div>
            <div class="col-md-4">
                <div class="alert alert-warning"><?php echo $detail['nb_semaines'] ?></div>
            </div>
        
            <div class="col-md-2">
                <div class="alert alert-success">Total</div>        
            </div>
            <div class="col-md-4">
                <div class="alert alert-success"><?php echo $detail['total']?>€</div>
            </div>
        </div>

       <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info text-right">Bon séjour  <i class="fab fa-phoenix-framework"></i> </div>
            </div>
        </div>


<?php } ?>









        <!-- Footer -->
        <div class="row mt-5 fixed-bottom" style="background-color: #bbdeda;">
                <div class="col-md-6 offset-md-3  ">
                    <footer>
                        <nav class="navbar navbar-expand-lg justify-content-center">
                            <ul class="nav">
                                <li class="nav-item text-secondary"><i class="fas fa-umbrella-beach"></i>Vos vacances de rêve ...</li>
                                <li class="nav-item text-secondary"><i class="fas fa-sun"></i>Plage ...</li>
                                <li class="nav-item text-secondary"><i class="fas fa-city"></i>Urbaine ...</li>
                                <li class="nav-item text-secondary"><i class="fas fa-ship"></i>Croisière ...</li>
                                <li class="nav-item text-secondary"><i class="fas fa-image"></i>Montagne ...</li>
                                <li class="nav-item text-secondary"><i class="fas fa-euro-sign"></i>A prix tout doux ...<i class="fas fa-umbrella-beach"></i></li>
                            </ul>
                        </nav>
                </footer>
            </div>
        </div>



<?php if ($_GET) { ?>
</div><!-- fin if($_GET)container -->
<?php }?>
</div><!-- fin container-fluid -->

<script src="https://kit.fontawesome.com/129f89009c.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
</body>
</html>