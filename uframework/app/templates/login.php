<html>
    <body>
        <form action="/login" method="POST">
            <input type="text" name="login" placeholder="login.."/>
            <input type="password" name="password" />
            <p><font color="red"><?php echo $erreur; ?></font></p>
            <input type="submit" value="Connect" />
        </form>
    </body>
</html>


