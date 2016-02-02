<?php
include __DIR__ . "/../model/cities.php";
$title=$cities[$_GET["id"]]["country"];
$lesVilles=array();
foreach($cities as $id => $citie){
    if(hash_equals($citie["country"],$title)){
        $lesVilles[]=$citie["name"];
    }
}
include __DIR__ . "/../view/country.php";