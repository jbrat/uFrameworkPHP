<?php
// ~/php/tp1/public/city.php

include __DIR__ . '/../model/cities.php';

/**
 * render a 404 page
 */
function page_not_found()
{
    header("HTTP/1.0 404 Not Found");
    include __DIR__ . '/../view/404.html';
    die();
}

// retrieve id from url parameter
$cityId = $_GET["id"];
if (!isset($cityId) || !is_numeric($cityId) || !isset($cities[$cityId])) {
    // No id given or invalid id
    page_not_found();
}

// retrieve city from dataset
$city  = $cities[$cityId];
// define some more variables
$title = sprintf("City %s", $city["name"]);

// include view
include __DIR__ . '/../view/city.php';