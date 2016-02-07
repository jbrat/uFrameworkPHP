<div style='border:2px;
            border-style:solid;
            '>
    <form action="/statuses" method="POST">
        <table style='
                   border-collapse: separate;
                   border-spacing : 5px;'>
            <tr>
                <td><label for="username">Utilisateur :</label></td>
                <td><input type="text" name="username" value="<?php echo $user; ?>"></td>
            </tr>
            <tr>
                <td><label for="message">Message :</label></td>
                <td><textarea name="message" value="<?php echo $message; ?>"></textarea></td>
            </tr>
            <tr>
                <td><p><font color="red"><?php echo $erreur; ?></font></p></td>
            </tr>
            <tr>
                <td><input type="submit" class='btn btn-primary' value="Envoyer"></td>
            </tr>
        </table>
    </form>   
</div>

