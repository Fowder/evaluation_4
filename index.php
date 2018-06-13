<?php 
$title = 'Gestion des réservations';
include 'components/head.php';
?>
<body>
<?php 
include 'components/nav.php';

include 'components/bdd.php';
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>ID<i class="fa fa-fw fa-sort desktop"></i></th>
            <th>Client<i class="fa fa-fw fa-sort desktop"></i></th>
            <th>Chambre<i class="fa fa-fw fa-sort desktop"></i></th>
            <th>Dates<i class="fa fa-fw fa-sort desktop"></i></th>
            <th class="desktop">Statut<i class="fa fa-fw fa-sort"></i></th>
            <th>Actions</th>
        <tr>
    </thead>
    <tbody>
        <?php
        $messagesParPage=10;
        $retour_total = $bdd->query($requete_total);
        $donnees_total= $retour_total->fetch();
        $total=$donnees_total['total'];
        $nombreDePages=ceil($total/$messagesParPage);
            if(isset($_GET['page']))
            {
                $pageActuelle=intval($_GET['page']);
            
                    if($pageActuelle>$nombreDePages)
                    {
                        $pageActuelle=$nombreDePages;
                    }
                    if($pageActuelle<=0){
                        $pageActuelle=1;
                    }
            }
            else
            {
                $pageActuelle=1;
            }

        $premiereEntree=($pageActuelle-1)*$messagesParPage;
        
        $reservations = $bdd->query($requete);

        while($reservation = $reservations->fetch()){
            echo '<tr>';
                echo '<td>'.$reservation['id'].'</td>';
                echo '<td>'.$reservation['prenom'].' '.$reservation['nom'].'</td>';
                echo '<td>N° '.$reservation['numero'].'</td>';
                echo '<td>Du '.substr ($reservation['dateEntree'], 0 , 10).' au '.substr ($reservation['dateSortie'], 0 , 10).'</td>';
                echo '<td class="desktop">'.$reservation['statut'].'</td>';
                echo '<td class="desktop"><a href="add_reservation.php?id='.$reservation['id'].'">Editer</a> - <a href="delete_reservation.php?id='.$reservation['id'].'">Supprimer</a></td>
                <td class="mobile">
                <div class="dropdown mobile">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="add_reservation.php?id='.$reservation['id'].'">Editer</a>
                    <a class="dropdown-item" href="delete_reservation.php?id='.$reservation['id'].'">Supprimer</a>
                </div>
                </div></td>';
            echo '</tr>';
            
        }

        echo '<p align="center">Page : ';
        for($i=1; $i<=$nombreDePages; $i++)
        {

            if($i==$pageActuelle)
            {
                echo '<button class="btn btn-primary">'.$i.'</button>'; 
            }	
            else
            {
                echo ' <a href="index.php?page='.$i.'"><button class="btn btn-secondary">'.$i.'</button></a> ';
            }
        }
        echo '</p>';
        ?>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>