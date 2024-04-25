<?php

$loader = require_once realpath(__DIR__ . '/../vendor/autoload.php');
$loader->addPsr4('Utils\\', '../Utils');
$loader->addPsr4('pagination\\', '../pagination');

use pagination\DataSourcePaginator;
use pagination\Paginator;

$DSPaginator = new DataSourcePaginator();
$paginator = new Paginator(5);

$sql = "SELECT * from animals";
$paginationlink = "pagination/getResult.php?page=";
$pagination_setting = $_GET["pagination_setting"];

$page = 1;
if (!empty($_GET["page"])) {
    $page = $_GET["page"];
}

$start = ($page - 1) * $paginator->perPage;
if ($start < 0) {
    $start = 0;
}

$query =  $sql . " limit " . $start . "," . $paginator->perPage;

$pageData = $DSPaginator->runQuery($query);

if (empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $DSPaginator->numRows($sql);
}

if ($pagination_setting == "prev-next") {
    $perpageresult = $paginator
      ->getPrevNext(
          $_GET["rowcount"],
          $paginationlink
      );
} else {
    $perpageresult = $paginator
      ->getAllPageLinks(
          $_GET["rowcount"],
          $paginationlink
      );
}

$output = '
<h1>Animal Names</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Common Name</th>
        <th>Scientific Name</th>
    </tr>';

foreach ($pageData as $page) {
    $output .= '
    <tr>
        <td>' . $page['id'] . '</td>
        <td>' . $page['common_name'] . '</td>
        <td>' . $page['scientific_name'] . '</td>
    </tr>';
}

$output .= '
</table>
<input type="hidden" id="rowcount" name="rowcount" value="'
     . $_GET["rowcount"] . '" />';

if (!empty($perpageresult)) {
    $output .= '
<div id="pag-container">    
<div id="pagination">'
     . $perpageresult . '
</div>
</div>';
}

print $output;
