<html>
    <body>
        <?php
            echo "Liste des status";
            echo "<ul>";
      
            foreach($statuses as $statut) {
                echo "<li>".$statut->getUser()."--> ".$statut->getMessage()." -- Le : ".$statut->getDate()."</li><form action='/statuses/".$statut->getId()."' method='POST'>
                      <input type='hidden' name='_method' value='DELETE'>
                      <input type='submit' value='Delete'>
                      </form>";
            }
            echo "</ul>";
        ?>
        <p>Ajouter un status en cliquant <a href="/statusesForm">ici</a></p>
    </body> 
</html>

