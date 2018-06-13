<?php 
include 'components/bdd.php';

$sql = $bdd->prepare('DELETE FROM reservations WHERE id='.$_GET['id'].'');
$sql->execute();

header('location:index.php');
?>