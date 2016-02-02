<?php
$autoload_map = array(
    'Coffee\Bali'        => 'Coffee/Bali.php',
    'Coffee\BlueMontain' => 'Coffee/BlueMontain.php',
    'Coffee\Sumatra'     => 'Coffee/Sumatra.php',
    'Soda\Lemonade'     => 'Soda/Lemonade.php',
    'Soda\Juice\Orange' => 'Soda/Juice/Orange.php',
    'Wine\Bordeaux'     => 'Wine/Bordeaux.php',
    'Wine\Chinon'       => 'Wine/Chinon.php',
);

$autoload = function($nameClass) use($autoload_map) {
    if(isset($autoload_map[$nameClass])) {
        require_once __DIR__."/".$autoload_map[$nameClass];
    } else {
        return false;
    }
};

spl_autoload_register($autoload);