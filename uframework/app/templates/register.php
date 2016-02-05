<html>
    <body>
        <form action="/register" method="POST">
            <label>Login : </label><input type="text" value="<?php echo $login; ?>" name="user" placeholder="login.."/>
            <label>Password : </label><input type="password" name="password" />
            <label>Repeat password : </label><input type="password" name="password2" />
            <input type="submit" value="Register" />
            <p><font color="red"><?php echo $erreur; ?></font></p>
        </form>
    </body>
</html>


