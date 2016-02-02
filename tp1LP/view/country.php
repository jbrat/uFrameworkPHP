<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <h1><?php echo $title; ?></h1>
        <table>
            <?php foreach($lesVilles as $id => $ville) echo '<tr><td><p>' . $ville . '</p></td></tr>'; ?>
        </table>
    </body>
</html>