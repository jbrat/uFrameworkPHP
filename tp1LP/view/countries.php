<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>All Countries</title>
    </head>
    <body>
        <h1>All Countries</h1>
        <table>
            <?php
                foreach($cities as $id => $citie){
                    if(in_array($citie,$cities)&&$id)
                    echo '<tr><td><a href="/country.php?id='.$id.'">' . $citie["country"] . '</a></td></tr>';
                }
            ?>
        </table>
    </body>
</html>
               