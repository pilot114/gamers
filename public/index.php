<?php

include '../vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] == '/admin') {
    echo 'TODO';
    exit;
}

$em = \App\Kernel::getORM();
$games = $em->getRepository('Entity\Game')->findAll();
foreach ($games as $game) {
    echo sprintf("<h1>%s</h1>", $game->getName());
    echo sprintf("<p>%s</p>", $game->getDescription());
    echo sprintf("<img src='%s' width='100px;' height='100px;'>", $game->getLogo());
}

echo file_get_contents('./index.html');