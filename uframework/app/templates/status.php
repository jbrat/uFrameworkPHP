<html>
    <body>
        <?php
            echo "Liste des status";
            echo "<ul>";
            foreach($data as $statut) {
                echo "<li>".$statut['user']." ".$statut['message']."</li><form action='/statuses/".$statut['id']."' method='POST'>
                      <input type='hidden' name='_method' value='DELETE'>
                      <input type='submit' value='Delete'>
                      </form>";
            }
            echo "</ul>";
        ?>
    </body> 
</html>

