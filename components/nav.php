<nav class="navbar navbar-light bg-light">
    <img src="" alt="logo">
    <span class="navbar-text">
        <?php echo $title; ?>
    </span>
    <?php 
    if(strstr($_SERVER['SCRIPT_FILENAME'], 'index')){
    ?>
    <form method="post">
        <select class="form-inline" name="select" id="exampleFormControlSelect1">
            <option>Filtres</option>
            <option>Validées</option>
            <option>Refusées</option>
            <option>En attente</option>
        </select>
        <button type="submit" name="submit" class="btn btn-success">Valider</button>
    </form>
    <a href="add_reservation.php"><button class="btn btn-primary">Ajouter une réservation</button></a>
    <?php 
    $requete_total = 'SELECT COUNT(*) AS total FROM reservations';

    $premiereEntree = 0;
    $messagesParPage = 10;
    if(isset($_GET['page'])){
        $pageActuelle = $_GET['page'];
        $premiereEntree = ($pageActuelle * 10) -10;
    }
    $requete = 'SELECT reservations.id, clients.nom, clients.prenom, chambres.numero, dateEntree, dateSortie, statut FROM chambres, clients, reservations WHERE chambres.id = reservations.chambreId AND clients.id = reservations.clientId ORDER BY reservations.id ASC LIMIT '.$premiereEntree.', '.$messagesParPage.'';
    }
    if(isset($_POST['submit'])){
        if($_POST['select'] == "Validées"){
            $pageActuelle = 1;
            $premiereEntree = ($pageActuelle * 10) -10;
            $requete_total = 'SELECT COUNT(*) AS total FROM reservations WHERE statut LIKE "valide"';
            $requete = 'SELECT reservations.id, clients.nom, clients.prenom, chambres.numero, dateEntree, dateSortie, statut FROM chambres, clients, reservations WHERE chambres.id = reservations.chambreId AND clients.id = reservations.clientId AND statut LIKE "valide" ORDER BY reservations.id ASC LIMIT '.$premiereEntree.', '.$messagesParPage.'';
        }else if($_POST['select'] == "Refusées"){
            $pageActuelle = 1;
            $premiereEntree = ($pageActuelle * 10) -10;
            $requete_total = 'SELECT COUNT(*) AS total FROM reservations WHERE statut LIKE "refus"';
            $requete = 'SELECT reservations.id, clients.nom, clients.prenom, chambres.numero, dateEntree, dateSortie, statut FROM chambres, clients, reservations WHERE chambres.id = reservations.chambreId AND clients.id = reservations.clientId AND statut LIKE "refus" ORDER BY reservations.id ASC LIMIT '.$premiereEntree.', '.$messagesParPage.'';
        }else if($_POST['select'] == "Filtres"){
            $requete_total = 'SELECT COUNT(*) AS total FROM reservations';
            $requete = 'SELECT reservations.id, clients.nom, clients.prenom, chambres.numero, dateEntree, dateSortie, statut FROM chambres, clients, reservations WHERE chambres.id = reservations.chambreId AND clients.id = reservations.clientId ORDER BY reservations.id ASC LIMIT '.$premiereEntree.', '.$messagesParPage.'';
        }else{
            $pageActuelle = 1;
            $premiereEntree = ($pageActuelle * 10) -10;
            $requete_total = 'SELECT COUNT(*) AS total FROM reservations WHERE statut LIKE "attente"';
            $requete = 'SELECT reservations.id, clients.nom, clients.prenom, chambres.numero, dateEntree, dateSortie, statut FROM chambres, clients, reservations WHERE chambres.id = reservations.chambreId AND clients.id = reservations.clientId AND statut LIKE "attente" ORDER BY reservations.id ASC LIMIT '.$premiereEntree.', '.$messagesParPage.''; 
        }
    }
    ?>
</nav>