<div style="
     border:1px;
     border-style: solid;">
    <p class="h1">
        Formulaire de connexion :
    </p>
    <form action="/login" method="POST">
        <table style='
               border-collapse: separate;
               border-spacing : 10px;'>
            <tbody>    
                    <tr>
                        <td><label>Login :</label></td><td><input type="text" name="login" value="<?php echo $login; ?>" placeholder="login.."/></td>
                    </tr>
                    <tr>
                        <td><label>Password :</label></td><td><input type="password" name="password" /></td>
                    </tr>  
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><p><font color="red"><?php echo $erreur; ?></font></p></td>
                    </tr>
                    <tr>    
                        <td><input type="submit" class="btn btn-primary" value="Connect" /></td>
                        <td><a href="/statuses">'<input type='button' class='btn btn-primary' value='retour'/></a></td>
                    </tr>
            </tbody>
        </table>
     </form>
    
</div>