<div class='col-md-2'>
    <p class='h3'>Bienvenue : <?php echo $login; ?></p>
</div>
<div class='col-md-10'>
<?php
    if($login != "Anonymous") {
       echo "<a href='/logout'><input type='button' class='btn' value='Se deconnecter'/></a>";
    } else {
?>
    <table style='
               border-collapse: separate;
               border-spacing : 5px;'>
        <tr>
            <td><a href='/login'><input type='button' value='Connexion' class='btn'/></a></td>
            <td><a href="/register"><input type='button' value="S'enregistrer" class='btn'/></a></td>
        </tr>
        
    </table>
    
    
    
    
    
<?php
    }
?>
</div>
<div class='col-md-12'>
<p class="h1">Liste des statuts :</p>
<table class="table table-condensed">
    <thead>
        <tr>
            <th>Author</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($statuses as $statut) {
                echo "<tr>";
                    echo "<td>".$statut->getUser()."</td>"
                        ."<td>".$statut->getMessage()."</td>"
                        ."<td>".$statut->getDate()."</td>"
                        ."<td>"
                            . "<a href='statuses/".$statut->getId()."'><input type='boutton' value='Lire' class='btn btn-primary'/></a>"
                            . "<form action='/statuses/".$statut->getId()."' method='POST'>"
                            . "<input type='hidden' name='_method' value='DELETE'>"
                            . "<input type='submit' type='button' class='btn btn-info' value='Delete'/>"
                            . "</form>";
                    echo "</td>";
                echo "</tr>";
            }
        ?>           
    </tbody>     
</table>
           
<a href="/statusesForm"><input type='button' class='btn btn-primary' value='Ajouter statut'</a>
</div>

