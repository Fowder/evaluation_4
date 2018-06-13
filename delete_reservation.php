<?php 
$title = 'Supprimer une réservation';
include 'components/head.php';
?>
<body>
<?php 
include 'components/nav.php';

include 'components/bdd.php';
?>
<div class="card text-center">
  <div class="card-body">
    <h5 class="card-title">Êtes-vous sûr de vouloir supprimer la réservation N°<?php echo $_GET['id'] ?> : </h5>
    <?php 
    $sql = $bdd->query('SELECT clients.nom, clients.prenom, chambres.numero, reservations.dateEntree, reservations.dateSortie FROM clients, chambres, reservations WHERE clients.id = reservations.clientId AND chambres.id = reservations.chambreId AND reservations.id = '.$_GET['id'].'');
    while($reservation = $sql->fetch()){
        echo '
        <p class="card-text">'.$reservation['prenom'].' '.$reservation['nom'].' / Chambre N°'.$reservation['numero'].'</p>
        <p class="card-text">Du '.substr ($reservation['dateEntree'], 0 , 10).'</p>
        <p class="card-text">au '.substr ($reservation['dateSortie'], 0 , 10).'</p>
        <a href="index.php"><button class="btn btn-primary">Annuler</button></a> <a href="confirm_delete.php?id='.$_GET['id'].'"><button class="btn btn-danger">Confirmer la suppression</button></a>
        ';
    }
    ?>
  </div>
</div>
</body>
</html>