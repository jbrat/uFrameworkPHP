<div style='border:1px;
            border-style:solid;'>
    
    <p class='h2'>S'enregistrer :</p>
    <form action="/register" method="POST">
        <table style='
               border-collapse: separate;
               border-spacing : 5px;'>
            <tr>
                <td>
                    <label>Login : </label>
                </td>
                <td>
                    <input type="text" value="<?php echo $login; ?>" name="user" placeholder="login.."/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password : </label>
                </td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Repeat password : </label>
                </td>
                <td>
                    <input type="password" name="password2" />
                </td>
            </tr>
            <tr>
                <td><p><font color="red"><?php echo $erreur; ?></font></p></td>
            </tr>
            <tr>
                <td><input type="submit" class='btn btn-primary' value="S'enregistrer" /></td>
                <td><a href="/statuses">'<input type='button' class='btn btn-primary' value='Retour'/></a></td>
            </tr>
        </table>
    </form>
</div>
