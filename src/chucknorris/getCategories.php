<?php

use Services\ChuckNorrisService;

$service = new ChuckNorrisService();
$categories = $service->getCategories();

// Output the data to inspect it
header('Content-Type: application/json');
echo json_encode($categories);
