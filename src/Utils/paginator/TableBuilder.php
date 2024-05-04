<?php

namespace Utils\paginator;

use Utils\paginator\DataSource;
use Utils\paginator\PageLinksGenerator;

class TableBuilder
{
    protected $fromTable = null;
    protected $linkGoToPage = null;
    protected $datasource = null;
    protected $linksGenerator = null;
    protected $resultsPerPage = null;
    protected $paginationSetting = null;

    public function __construct(
        $fromTable,
        $linkGoToPage,
        $resultsPerPage,
        $paginationSetting
    ) {
        $this->fromTable = $fromTable;
        $this->linkGoToPage = $linkGoToPage;
        $this->resultsPerPage = $resultsPerPage;
        $this->datasource = new DataSource();
        $this->linksGenerator = new PageLinksGenerator($resultsPerPage);
        $this->paginationSetting = $paginationSetting;
    }

    public function getResultsAt($row)
    {
        $selectAllFromTableSql = "SELECT * FROM " . $this->fromTable;
        // linkGoToPage = "pagination/getResult.php?page="
        $linkGoToPage = $this->linkGoToPage;
        $pagination_setting = $_GET["pagination_setting"];
        $resultsPerPage = $this->resultsPerPage;
        $ds = $this->datasource;
        $linksGenerator = $this->linksGenerator;
        $totalRows = $ds->numRowsOf($selectAllFromTableSql);

        $start = ($row - 1) * $resultsPerPage;
        if ($start < 0) {
            $start = 0;
        }

        $selectWithLimit =  $selectAllFromTableSql . " LIMIT " . $start . "," . $resultsPerPage;

        $tableData = $ds->runQuery($selectWithLimit);

        if ($pagination_setting == "prev-next") {
            $paginationLinks = $linksGenerator
              ->getPrevNext(
                  $totalRows,
                  $linkGoToPage
              );
        } else {
            $paginationLinks = $linksGenerator
              ->getAllPageLinks(
                  $totalRows,
                  $linkGoToPage
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

        foreach ($tableData as $currentPage) {
            $output .= '
    <tr>
        <td>' . $currentPage['id'] . '</td>
        <td>' . $currentPage['common_name'] . '</td>
        <td>' . $currentPage['scientific_name'] . '</td>
    </tr>';
        }

        $output .= '
</table>
<input type="hidden" id="rowcount" name="rowcount" value="'
        . $_GET["rowcount"] . '" />';

        if (!empty($paginationLinks)) {
            $output .= '
<div id="pag-container">    
<div id="pagination">'
             . $paginationLinks . '
</div>
</div>';
        }

        print $output;
    }
}
