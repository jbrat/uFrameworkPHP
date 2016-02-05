<html>    
    <body>
        <form action="/statuses" method="POST">
          <label for="username">Username:</label>
          <input type="text" name="username" value="<?php echo $user; ?>">

          <label for="message">Message:</label>
          <textarea name="message" value="<?php echo $message; ?>"></textarea>
          <p><font color="red"><?php echo $erreur; ?></font></p>
          <input type="submit" value="Tweet!">
        </form>   
    </body>
</html>


