<?php

use Services\ChuckNorrisService;

$category = $_GET['category'] ?? null;
$service = new ChuckNorrisService();
$joke = $service->getRandomJoke($category);

// Output the data to inspect it
header('Content-Type: application/json');
echo json_encode($joke);
