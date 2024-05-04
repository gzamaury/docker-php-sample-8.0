<?php

$loader = require_once realpath(__DIR__ . '/vendor/autoload.php');
$loader->addPsr4('Utils\\', 'Utils');
$loader->addPsr4('Services\\', 'Services');

use Utils\paginator\TableBuilder;

$resultsPerPage = 5;

$tableAnimals = "animals";
$linkGoToPage = "getResult.php?page=";
$paginationSetting = $_GET["pagination_setting"];

$currentPage = !empty($_GET["page"]) ? $_GET["page"] : 1 ;

$tableBuilder = new TableBuilder(
    $tableAnimals,
    $linkGoToPage,
    $resultsPerPage,
    $paginationSetting
);

print $tableBuilder->getResultsAt($currentPage);
