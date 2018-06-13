<?php 
$title = 'Ajouter/Modifier une réservation';
include 'components/head.php';
?>
<body>
<?php 
include 'components/nav.php';

include 'components/bdd.php';

$id = $_GET['id'];
?>



<div class="container text-center">
    <form method="POST" action="add_modify_reservation.php?id=<?php echo $id ?>">
        <div class="form-group">
            <label for="select_client">Client :</label>
            <select id="select_client" name="client">
                <?php

                $sql = $bdd->query('SELECT nom, prenom, id FROM clients');
                if(isset($_GET['id'])){
                    $retrieve_client = $bdd->query('SELECT clients.id, reservations.clientId, clients.nom, clients.prenom FROM clients, reservations WHERE clients.id = reservations.clientId AND reservations.id='.$_GET['id'].'');
                    $ret_fetch_client = $retrieve_client->fetch();
                    echo '<option value="'.$ret_fetch_client['id'].'" selected>'.$ret_fetch_client['prenom'].' '.$ret_fetch_client['nom'].'</option>';
                }
                while($client = $sql->fetch()){
                    if($ret_fetch_client['clientId'] == $client['id']){

                    }else{
                        echo '<option value="'.$client['id'].'">'.$client['prenom'].' '.$client['nom'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="select_chambre">Chambre :</label>
            <select id="select_chambre" name="chambre">
                <?php
                $sql = $bdd->query('SELECT nom, numero, id FROM chambres');

                if(isset($_GET['id'])){
                    $retrieve_chambre = $bdd->query('SELECT reservations.id, reservations.chambreId, chambres.nom, chambres.numero FROM chambres, reservations WHERE chambres.id = reservations.chambreId AND reservations.id='.$_GET['id'].'');
                    $ret_fetch_chambre = $retrieve_chambre->fetch();
                    echo '<option value="'.$ret_fetch_chambre['id'].'" selected>N°'.$ret_fetch_chambre['numero'].' : '.$ret_fetch_chambre['nom'].'</option>';
                }
                while($chambre = $sql->fetch()){
                    if($ret_fetch_chambre['chambreId'] == $chambre['id']){

                    }else{
                        echo '<option value="'.$chambre['id'].'">N°'.$chambre['numero'].' : '.$chambre['nom'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="input_date_entree">Date entrée :</label>
            <?php
            if(isset($_GET['id'])){
                $sql = $bdd->query('SELECT dateEntree FROM reservations WHERE id='.$_GET['id'].'');
                $dateEntree = $sql->fetch();
                echo '<input id="input_date_entree" type="date" name="dateEntree" value="'.substr ($dateEntree['dateEntree'], 0 , 10).'">';
            }else{
                echo '<input id="input_date_entree" type="date" name="dateEntree">';
            }
            ?>
        </div>
        <div class="form-group">
            <label for="input_date_sortie">Date sortie :</label>
            <?php
            if(isset($_GET['id'])){
                $sql = $bdd->query('SELECT dateSortie FROM reservations WHERE id='.$_GET['id'].'');
                $dateSortie = $sql->fetch();
                echo '<input id="input_date_sortie" type="date" name="dateSortie" value="'.substr ($dateSortie['dateSortie'], 0 , 10).'">';
            }else{
                echo '<input id="input_date_sortie" type="date" name="dateSortie">';
            }
            ?>
        </div>
        <div class="form-group">
            <label for="select_statut">Statut :</label>
            <select id="select_statut" name="statut">
                <?php
                $sql = $bdd->query('SELECT statut FROM reservations GROUP BY statut');
                if(isset($_GET['id'])){
                    $retrieve_statut = $bdd->query('SELECT statut FROM reservations WHERE reservations.id='.$_GET['id'].'');
                    $ret_fetch_statut = $retrieve_statut->fetch();
                    echo '<option value="'.$ret_fetch_statut['statut'].'">'.$ret_fetch_statut['statut'].'</option>';
                }
                while($statut = $sql->fetch()){
                    if($ret_fetch_statut['statut'] == $statut['statut']){

                    }else{
                        echo '<option value="'.$statut['statut'].'">'.$statut['statut'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    <a href="/index.php">Retour</a>
</div>
</body>
</html>