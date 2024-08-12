<?php

use Services\ChuckNorrisService;

$query = $_GET['query'] ?? '';
$service = new ChuckNorrisService();
$result = $service->searchJokes($query);

// Output the data to inspect it
header('Content-Type: application/json');
echo json_encode($result);
