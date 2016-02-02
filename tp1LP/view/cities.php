<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>All Cities</title>
    </head>
    <body>
        <h1>All Cities</h1>
        <table>
        <?php foreach ($cities as $cityId => $city) : ?>
            <tr>
                <td><a href="/city.php?id=<?= $cityId; ?>"><?= $city['name']; ?></a></td>
                <td><?= $city['country']; ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
    </body>
</html>