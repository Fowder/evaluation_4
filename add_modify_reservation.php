<?php 
include 'components/bdd.php';

if($_GET['id'] == ""){
    $add = $bdd->prepare('INSERT INTO reservations(clientId, chambreId, dateEntree, dateSortie, statut) VALUES (:clientId, :chambreId, :dateEntree, :dateSortie, :statut)');
    $add->execute(array(':clientId' => $_POST['client'], ':chambreId' => $_POST['chambre'], ':dateEntree' => $_POST['dateEntree'], ':dateSortie' => $_POST['dateSortie'], ':statut' => $_POST['statut']));
}else{
    $modify = $bdd->prepare('UPDATE reservations SET clientId = '.$_POST['client'].', chambreId = '.$_POST['chambre'].', dateEntree = "'.$_POST['dateEntree'].'", dateSortie = "'.$_POST['dateSortie'].'", statut = "'.$_POST['statut'].'" WHERE id = '.$_GET['id'].'');
    $modify->execute();
}
header('location:index.php');
?>