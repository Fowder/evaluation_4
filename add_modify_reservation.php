<?php 
include 'components/bdd.php';

if($_GET['id'] == ""){
    $add = $bdd->prepare('INSERT INTO reservations(clientId, chambreId, dateEntree, dateSortie, statut) VALUES (:clientId, :chambreId, :dateEntree, :dateSortie, :statut)');
    $add->execute(array(':clientId' => intval($_POST['client']), ':chambreId' => intval($_POST['chambre']), ':dateEntree' => $_POST['dateEntree'], ':dateSortie' => $_POST['dateSortie'], ':statut' => $_POST['statut']));
}else{
    $modify = $bdd->prepare('UPDATE reservations SET clientId = '.intval($_POST['client']).', chambreId = '.intval($_POST['chambre']).', dateEntree = "'.$_POST['dateEntree'].'", dateSortie = "'.$_POST['dateSortie'].'", statut = "'.$_POST['statut'].'" WHERE id = '.$_GET['id'].'');
    $modify->execute();
}
header('location:index.php');
?>